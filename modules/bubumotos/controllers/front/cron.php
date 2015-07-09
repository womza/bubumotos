<?php

class bubumotoscronModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        $this->_cron();
        die;
    }

    private function _cron()
    {
        $this->_entityCategories();
        $this->_entityManufacturers();
        $this->_entityCombinations();
        $this->_entityProducts();
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
        //var_dump($csv);
    }

    private function _entityManufacturers()
    {
        $url = Configuration::get('BUBUMOTOS_URL') . '?entity=manufacturers&key='
            . Configuration::get('BUBUMOTOS_API_KEY');
        $csv = $this->getCSVContentFromUrl($url);
        //var_dump($csv);
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