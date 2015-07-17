<?php

class bubumotoscronModuleFrontController extends ModuleFrontController
{
    private $_default_lang;
    private $_id_shop;

    public function initContent()
    {
        $this->_default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $this->_id_shop = Context::getContext()->shop->id;    // by default

        $this->_cron();
        die;
    }

    private function _cron()
    {
        //$this->_entityCategories();
        $this->_entityManufacturers();
        //$this->_entityCombinations();
        //$this->_entityProducts();
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
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=categories&key='
            . Configuration::get('BUBUMOTOS_API_KEY');
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
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=manufacturers&key='
            . Configuration::get('BUBUMOTOS_API_KEY');
        $csv = $this->getCSVContentFromUrl($url);
        //var_dump($csv);
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

    private function _entityCombinations()
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=combinations&key='
            . Configuration::get('BUBUMOTOS_API_KEY');
        $csv = $this->getCSVContentFromUrl($url);
        //var_dump($csv);
    }

    /* TIENE PROBLEMAS, VERIFICAR */
    private function _entityProducts()
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=products&key='
            . Configuration::get('BUBUMOTOS_API_KEY');
        $csv = $this->getCSVContentFromUrl($url);
        //var_dump($csv);
    }
}