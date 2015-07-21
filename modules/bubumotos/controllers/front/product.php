<?php

class bubumotosproductModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        Db::getInstance()->Execute('UPDATE `'._DB_PREFIX_.'stock_available` SET out_of_stock = 2');
        print 'all product update to order out of stock';
        die;
    }
}