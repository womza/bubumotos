<?php

if (!defined('_PS_VERSION_'))
    exit;

class Bubumotos extends Module
{
    private $_key;

    public function __construct()
    {
        $this->name = 'bubumotos';
        $this->tab = 'migration_tools';
        $this->version = '1.0.0';
        $this->author = 'William Ortega';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        // Api Key
        $this->_key = 'WV1Y5Z9s6EEP66jTzYb9N5ZcQb9NPq5D';

        $this->displayName = $this->l('Bubumotos');
        $this->description = $this->l('Module for import data');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('BUBUMOTOS_API_KEY'))
            $this->warning = $this->l('No name provided');
    }

    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);

        if (!parent::install() ||
            !Configuration::updateValue('BUBUMOTOS_API_KEY', $this->_key) ||
            !Configuration::updateValue('BUBUMOTOS_URL', '')
        )
            return false;

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() ||
            !Configuration::deleteByName('BUBUMOTOS_API_KEY') ||
            !Configuration::deleteByName('BUBUMOTOS_URL')
        )
            return false;

        return true;
    }

    public function getContent()
    {
        $output = null;

        if (Tools::isSubmit('submit'.$this->name))
        {
            $bubumotos = strval(Tools::getValue('BUBUMOTOS_API_KEY'));
            $bubumotos_url = strval(Tools::getValue('BUBUMOTOS_URL'));
            if (!$bubumotos || !$bubumotos_url
                || empty($bubumotos) || empty($bubumotos_url)
                || !Validate::isGenericName($bubumotos) || !Validate::isGenericName($bubumotos_url))
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            else
            {
                Configuration::updateValue('BUBUMOTOS_API_KEY', $bubumotos);
                Configuration::updateValue('BUBUMOTOS_URL', $bubumotos_url);
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
        return $output.$this->displayForm();
    }

    public function displayForm()
    {
        // Get default language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('API Key'),
                    'name' => 'BUBUMOTOS_API_KEY',
                    'size' => 20,
                    'required' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('URL'),
                    'name' => 'BUBUMOTOS_URL',
                    'size' => 20,
                    'required' => true
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
                array(
                    'desc' => $this->l('Save'),
                    'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                        '&token='.Tools::getAdminTokenLite('AdminModules'),
                ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        // Load current value
        $helper->fields_value['BUBUMOTOS_API_KEY'] = Configuration::get('BUBUMOTOS_API_KEY');
        $helper->fields_value['BUBUMOTOS_URL'] = Configuration::get('BUBUMOTOS_URL');

        return $helper->generateForm($fields_form);
    }
}