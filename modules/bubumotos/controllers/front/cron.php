<?php

class bubumotoscronModuleFrontController extends ModuleFrontController
{
    private $_default_lang;
    private $_id_shop;

    public function initContent()
    {
        $this->_default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $this->_id_shop = Context::getContext()->shop->id;    // by default

        if (Tools::getValue('type') === 'category') {
            $this->_entityCategories();
        } elseif (Tools::getValue('type') === 'manufacturer') {
            $this->_entityManufacturers();
        } elseif (Tools::getValue('type') === 'product') {
            // run this before combinations
            $page = (int)Tools::getValue('page', 1);
            $this->_entityProducts($page);
        } elseif (Tools::getValue('type') === 'combination') {
            // run this before combinations
            $page = (int)Tools::getValue('page', 1);
            $this->_entityCombinations($page);
        }

        die;
    }


    /**
     * Get CSV from URL
     *
     * @param $url
     * @return array
     */
    protected function getCSVContentFromUrl($url)
    {
        $parse_csv = array();
        $csv = array_map('str_getcsv', explode( "\n", file_get_contents($url) ));

        // take first row as titles and delete it
        $keys = explode(';', $csv[0][0]);
        unset($csv[0]);

        foreach ($csv as $content) {
            $temp = array();
            // html_entity_decode avoid encode to html
            $row = explode(';', html_entity_decode(implode('', $content)));
            for ($i = 0; $i < count($row); $i++)
                $temp[$keys[$i]] = $this->removeDoubleQuotes($row[$i]);
            if (count($temp) > 1)
                $parse_csv[] = $temp;
        }
        return $parse_csv;
    }


    protected function getImageFromUrl($path, $url)
    {
        file_put_contents($path, file_get_contents($url));
    }


    /**
     * Remove double quotes
     *
     * @param $str
     * @return string
     */
    protected function removeDoubleQuotes($str)
    {
        if (substr($str, 0, 1) === '"' && substr($str, -1) === '"') {
            $str = substr($str, 1);
            $str = substr($str, 0, -1);
            // also remove white space
            $str = trim($str);
        }
        return $str;
    }


    /// Get CSV from URL for each entity

    private function _entityCategories()
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=categories&page=1&itemsPerPage=100&key='
            . Configuration::get('BUBUMOTOS_API_KEY') . '&type=csv';
        $csv = $this->getCSVContentFromUrl($url);
        foreach ($csv as $cat) {
            $id_category = (int)$cat['id'];
            $date_add = date('Y-m-d H:i:s', time());

            $data['id_category'] = $id_category;
            $data['id_parent'] = (int)$cat['parent_category'];
            $data['id_shop_default'] = $this->_id_shop;
            $data['active'] = (int)$cat['active'];
            $data['date_add'] = $date_add;
            $data['date_upd'] = $date_add;
            $data['position'] = 1;

            $datal['id_category'] = $id_category;
            $datal['id_shop'] = $this->_id_shop;
            $datal['id_lang'] = $this->_default_lang;
            $datal['name'] = pSQL($cat['name']);
            $datal['description'] = pSQL($cat['description']);
            $datal['link_rewrite'] = pSQL($cat['url_rewritten']);
            $datal['meta_title'] = pSQL($cat['meta_title']);
            $datal['meta_keywords'] = pSQL($cat['seo_meta_keywords']);
            $datal['meta_description'] = pSQL($cat['meta_description']);

            $dataShop['id_category'] = (int)$cat['id'];
            $dataShop['id_shop'] = $this->_id_shop;
            $dataShop['position'] = 1;

            if(!DB::getInstance()->insert('category', $data))
                die('Error in category insert : '.$id_category);
            if(!DB::getInstance()->insert('category_lang', $datal))
                die('Error in category lang insert : '.$id_category);
            if(!DB::getInstance()->insert('category_shop', $dataShop))
                die('Error in category shop insert : '.$id_category);
        }
    }

    private function _entityManufacturers()
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=manufacturers&page=1&itemsPerPage=150&key='
            . Configuration::get('BUBUMOTOS_API_KEY') . '&type=csv';
        $csv = $this->getCSVContentFromUrl($url);
        foreach ($csv as $manufacturer) {
            $id_manufacturer = (int)$manufacturer['id'];
            $date_add = date('Y-m-d H:i:s', time());

            $data['id_manufacturer'] = $id_manufacturer;
            $data['name'] = pSQL($manufacturer['name']);
            $data['date_add'] = $date_add;
            $data['date_upd'] = $date_add;
            $data['active'] = (int)$manufacturer['active'];

            $datal['id_manufacturer'] = $id_manufacturer;
            $datal['id_lang'] = $this->_default_lang;
            $datal['description'] = pSQL($manufacturer['description']);
            $datal['short_description'] = pSQL($manufacturer['short_description']);
            $datal['meta_title'] = pSQL($manufacturer['meta_title']);
            $datal['meta_keywords'] = pSQL($manufacturer['meta_keywords']);
            $datal['meta_description'] = pSQL($manufacturer['meta_description']);

            $dataShop['id_manufacturer'] = $id_manufacturer;
            $dataShop['id_shop'] = $this->_id_shop;

            if(!DB::getInstance()->insert('manufacturer', $data))
                die('Error in manufacturer insert : '.$id_manufacturer);
            if(!DB::getInstance()->insert('manufacturer_lang', $datal))
                die('Error in manufacturer lang insert : '.$id_manufacturer);
            if(!DB::getInstance()->insert('manufacturer_shop', $dataShop))
                die('Error in manufacturer shop insert : '.$id_manufacturer);

            // after save, the img is downloaded and put in img folder
            // save in manufacturer folder
            $image_origin = $manufacturer['image_url'];
            // check if origin have image
            if (strpos($image_origin, 'jpg') !== false) {
                $image_destinatio = _PS_MANU_IMG_DIR_ . $id_manufacturer . '.jpg';
                $this->getImageFromUrl($image_destinatio, $image_origin);
                if (file_exists(_PS_MANU_IMG_DIR_ . $id_manufacturer . '.jpg')) {
                    $images_types = ImageType::getImagesTypes('manufacturers');
                    foreach ($images_types as $k => $image_type) {
                        ImageManager::resize(
                            _PS_MANU_IMG_DIR_ . $id_manufacturer . '.jpg',
                            _PS_MANU_IMG_DIR_ . $id_manufacturer . '-' . stripslashes($image_type['name']) . '.jpg',
                            (int)$image_type['width'],
                            (int)$image_type['height']
                        );
                    }

                    // save in temp manufacturer folder
                    $image_origin = $manufacturer['image_url'];
                    $image_destinatio = _PS_TMP_IMG_DIR_ . 'manufacturer_mini_' . $id_manufacturer . '_' . $this->_id_shop . '.jpg';
                    $this->getImageFromUrl($image_destinatio, $image_origin);
                }
            }
        }
    }

    private function _entityCombinations($page = 1)
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=combinations&page='.$page.'&itemsPerPage=3000&key='
            . Configuration::get('BUBUMOTOS_API_KEY') . '&type=csv';
        $csv = $this->getCSVContentFromUrl($url);
        //var_dump($csv);
        //$product = new Product($product_id);
        //$product->addCombinationEntity();
    }


    private function _entityProducts($page = 1)
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=products&page='.$page.'&itemsPerPage=500&key='
            . Configuration::get('BUBUMOTOS_API_KEY') . '&type=xml';
        $xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);

        // get all ids of products
        $products = Db::getInstance()->executeS('SELECT id_product FROM `'._DB_PREFIX_.'product`');
        $ids = array();
        foreach ($products as $p)
            $ids[] = (int)$p['id_product'];

        foreach ($xml as $product) {
            $id_product = (int)$product->id;

            $data['id_product'] = $id_product;
            $data['id_supplier'] = (int)$product->supplier;
            $data['id_manufacturer'] = (int)$product->manufacturer;
            $data['id_category_default'] = 2; // as default category
            $data['id_shop_default'] = ($this->_id_shop == (int)$product->shop_id) ? $this->_id_shop : (int)$product->shop_id;
            $data['id_tax_rules_group'] = (int)$product->tax_rules_ID;
            $data['on_sale'] = (int)$product->on_sale;
            $data['online_only'] = (int)$product->available_online_only;
            $data['ean13'] = pSQL($product->EAN13);
            $data['upc'] = pSQL($product->UPC);
            $data['ecotax'] = (float)$product->ecotax;
            $data['quantity'] = (int)$product->quantity;
            $data['minimal_quantity'] = (int)$product->minimal_quantity;
            $data['price'] = (float)$product->price;
            $data['wholesale_price'] = (float)$product->wholesale_price;
            $data['unity'] = pSQL($product->unity);
            $data['unit_price_ratio'] = (float)$product->unit_price;
            $data['additional_shipping_cost'] = (float)$product->additional_shipping_cost;
            $data['reference'] = pSQL($product->reference);
            $data['supplier_reference'] = pSQL($product->supplier_reference);
            $data['width'] = (float)$product->width;
            $data['height'] = (float)$product->height;
            $data['depth'] = (float)$product->depth;
            $data['weight'] = (float)$product->weight;
            $data['out_of_stock'] = (int)$product->out_of_stock;
            $data['customizable'] = (int)$product->customizable;
            $data['uploadable_files'] = (int)$product->uploadable;
            $data['text_fields'] = (int)$product->text_fields;
            $data['active'] = (int)$product->active;
            $data['available_for_order'] = (int)$product->available_for_order;
            $data['available_date'] = (string)$product->product_available_date;
            if (!empty($product->condition_))
              $data['condition'] = pSQL($product->condition_);
            $data['show_price'] = (int)$product->show_price;
            if (!empty($product->visibility))
              $data['visibility'] = pSQL($product->visibility);
            $data['date_add'] = (string)$product->product_creation_date;
            $data['date_upd'] = (string)$product->product_creation_date;
            $data['advanced_stock_management'] = (int)$product->advanced_stock_management;


            $datal['id_product'] = $id_product;
            $datal['id_shop'] = $data['id_shop_default'];
            $datal['id_lang'] = $this->_default_lang;
            $datal['description'] = pSQL($product->description);
            $datal['description_short'] = pSQL($product->short_description);
            $datal['link_rewrite'] = pSQL($product->url_rewrite);
            $datal['meta_description'] = pSQL($product->meta_description);
            $datal['meta_keywords'] = pSQL($product->meta_keywords);
            $datal['meta_title'] = pSQL($product->meta_title);
            $datal['name'] = pSQL($product->meta_title);
            $datal['available_now'] = pSQL($product->text_when_in_stock);
            $datal['available_later'] = pSQL($product->text_when_backorder_allowed);


            $dataShop['id_product'] = $id_product;
            $dataShop['id_shop'] = ($this->_id_shop == (int)$product->shop_id) ? $this->_id_shop : (int)$product->shop_id;
            $dataShop['id_category_default'] = 2; // as default category
            $dataShop['id_tax_rules_group'] = (int)$product->tax_rules_ID;
            $dataShop['on_sale'] = (int)$product->on_sale;
            $dataShop['online_only'] = (int)$product->available_online_only;
            $dataShop['ecotax'] = (float)$product->ecotax;
            $dataShop['minimal_quantity'] = (int)$product->minimal_quantity;
            $dataShop['price'] = (float)$product->price;
            $dataShop['wholesale_price'] = (float)$product->wholesale_price;
            $dataShop['unity'] = pSQL($product->unity);
            $dataShop['unit_price_ratio'] = (float)$product->unit_price;
            $dataShop['additional_shipping_cost'] = (float)$product->additional_shipping_cost;
            $dataShop['customizable'] = (int)$product->customizable;
            $dataShop['uploadable_files'] = (int)$product->uploadable;
            $dataShop['text_fields'] = (int)$product->text_fields;
            $dataShop['active'] = (int)$product->active;
            $dataShop['available_for_order'] = (int)$product->available_for_order;
            $dataShop['available_date'] = (string)$product->product_available_date;
            if (!empty($product->condition_))
              $dataShop['condition'] = pSQL($product->condition_);
            $dataShop['show_price'] = (int)$product->show_price;
            if (!empty($product->visibility))
              $dataShop['visibility'] = pSQL($product->visibility);
            $dataShop['advanced_stock_management'] = (int)$product->advanced_stock_management;
            $dataShop['date_add'] = (string)$product->product_creation_date;
            $dataShop['date_upd'] = (string)$product->product_creation_date;

            // check if the product exists in database
            if (!in_array($id_product, $ids)) {
                if(!DB::getInstance()->insert('product', $data))
                    die('Error in product insert : '.$id_product);
                if(!DB::getInstance()->insert('product_lang', $datal))
                    die('Error in product lang insert : '.$id_product);
                if(!DB::getInstance()->insert('product_shop', $dataShop))
                    die('Error in product shop insert : '.$id_product);
                // save images of product
                if (strlen($product->image_urls)) {
                    $images = explode(',', $product->image_urls);
                    $id_image = Product::getCover($id_product);
                    $shops = Shop::getShops(true, null, true);
                    foreach ($images as $img) {
                        $image_url = $img;
                        $image = new Image();
                        $image->id_product = $id_product;
                        $image->position = Image::getHighestPosition($id_product) + 1;
                        $image->cover = true; // or false;
                        if (($image->validateFields(false, true)) === true &&
                            ($image->validateFieldsLang(false, true)) === true && $image->add())
                        {
                            $image->associateTo($shops);
                            if (!$this->copyImg($id_product, $image->id, $image_url, 'products', false))
                            {
                                $image->delete();
                            }
                        }
                    }
                }
            }
        }
    }


    protected function copyImg($id_entity, $id_image = null, $url, $entity = 'products', $regenerate = true)
    {
        $tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import');
        $watermark_types = explode(',', Configuration::get('WATERMARK_TYPES'));

        switch ($entity)
        {
            default:
            case 'products':
                $image_obj = new Image($id_image);
                $path = $image_obj->getPathForCreation();
                break;
            case 'categories':
                $path = _PS_CAT_IMG_DIR_.(int)$id_entity;
                break;
            case 'manufacturers':
                $path = _PS_MANU_IMG_DIR_.(int)$id_entity;
                break;
            case 'suppliers':
                $path = _PS_SUPP_IMG_DIR_.(int)$id_entity;
                break;
        }

        $url = str_replace(' ', '%20', trim($url));
        $url = urldecode($url);
        $parced_url = parse_url($url);

        if (isset($parced_url['path']))
        {
            $uri = ltrim($parced_url['path'], '/');
            $parts = explode('/', $uri);
            foreach ($parts as &$part)
                $part = urlencode ($part);
            unset($part);
            $parced_url['path'] = '/'.implode('/', $parts);
        }

        if (isset($parced_url['query']))
        {
            $query_parts = array();
            parse_str($parced_url['query'], $query_parts);
            $parced_url['query'] = http_build_query($query_parts);
        }

        if (!function_exists('http_build_url'))
            require_once(_PS_TOOL_DIR_.'http_build_url/http_build_url.php');

        $url = http_build_url('', $parced_url);

        // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
        if (!ImageManager::checkImageMemoryLimit($url))
            return false;

        // 'file_exists' doesn't work on distant file, and getimagesize makes the import slower.
        // Just hide the warning, the processing will be the same.
        if (Tools::copy($url, $tmpfile))
        {
            ImageManager::resize($tmpfile, $path.'.jpg');
            $images_types = ImageType::getImagesTypes($entity);

            if ($regenerate)
                foreach ($images_types as $image_type)
                {
                    ImageManager::resize($tmpfile, $path.'-'.stripslashes($image_type['name']).'.jpg', $image_type['width'], $image_type['height']);
                    if (in_array($image_type['id_image_type'], $watermark_types))
                        Hook::exec('actionWatermark', array('id_image' => $id_image, 'id_product' => $id_entity));
                }
        }
        else
        {
            unlink($tmpfile);
            return false;
        }
        unlink($tmpfile);
        return true;
    }
}
