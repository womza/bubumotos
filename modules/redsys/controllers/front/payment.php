<?php
/**
 * 2011-2014 OBSolutions S.C.P. All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 *
 *  @author    OBSolutions SCP <http://addons.prestashop.com/en/65_obs-solutions>
 *  @copyright 2011-2014 OBSolutions SCP
 *  @license   OBSolutions S.C.P. All Rights Reserved
 *  International Registered Trademark & Property of OBSolutions SCP
 */

class RedsysPaymentModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		$this->display_column_right = false;
		parent::initContent();

		$cart = $this->context->cart;
		if (!$this->module->checkCurrency($cart))
			Tools::redirect('index.php?controller=order');

		$idCart = $cart->id;
		$secureKey = $cart->secure_key;
		$products = $cart->getProducts();
		$locale = Language::getIsoById($this->context->cookie->id_lang);
		$sandbox_mode = Configuration::get('REDSYS_SANDBOX');

		if ($sandbox_mode == '1')
			$url_tpvv = 'https://sis-t.redsys.es:25443/sis/realizarPago';
		else
			$url_tpvv = 'https://sis.redsys.es/sis/realizarPago';

		$cartProducts = '';
		foreach ($products as $product)
		{
			$cartProducts .= '- '.$product['name'];
			if (isset($product['attributes']) && $product['attributes'] != '')
			{
				$arrayAttributes = preg_split('/, /', $product['attributes']);
				foreach ($arrayAttributes as $attribute)
					$cartProducts .= ' - '.$attribute;
			}

			$cartProducts .= '<br/><br/>';
		}

		//Language Virtual POS
		$tpvLang = '1';
		switch ($locale)
		{
			case 'es':
				$tpvLang = '1';
				break;
			case 'gb':
			case 'en':
				$tpvLang = '2';
				break;
			case 'ca':
				$tpvLang = '3';
				break;
			case 'fr':
				$tpvLang = '4';
				break;
			case 'de':
				$tpvLang = '5';
				break;
			case 'nl':
				$tpvLang = '6';
				break;
			case 'it':
				$tpvLang = '7';
				break;
			case 'se':
				$tpvLang = '8';
				break;
			case 'pt':
				$tpvLang = '9';
				break;
			case 'pl':
				$tpvLang = '11';
				break;
			case 'gl':
				$tpvLang = '12';
				break;
		}

		// OLD
		//$amount = (float)$cart->getOrderTotal(true, Cart::BOTH) * 100;

		//CURRENCY CONVERSION
		$cartCurrency = new Currency((int)$cart->id_currency);
		$tpvCurrencyId = Currency::getIdByIsoCodeNum(Configuration::get('REDSYS_CURRENCY'));

		if($tpvCurrencyId)
			$tpvCurrency = new Currency($tpvCurrencyId);
		else
			$tpvCurrency = new Currency((int)Configuration::get('PS_CURRENCY_DEFAULT'));

		$amount = (float) Tools::convertPriceFull($cart->getOrderTotal(true, Cart::BOTH), $cartCurrency, $tpvCurrency) * 100;
		//END CURRENCY CONVERSION

		$urlOK = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.
			'modules/redsys/resultRedirect.php?result=0&cartId='.$idCart.
			(Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1?'&content_only=1':'');
		$urlNOK = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.
			'modules/redsys/resultRedirect.php?result=1&cartId='.$idCart.
			(Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1?'&content_only=1':'');

		$orderId = date('ymdHis');

		$this->context->smarty->assign(array(
			'id_cart' => $idCart,
			'url_tpvv' => $url_tpvv,
			'MerchantCode' => Configuration::get('REDSYS_MERCHANT_CODE'),
			'MerchantName' => Configuration::get('REDSYS_MERCHANT_NAME'),
			'TerminalNum' => Configuration::get('REDSYS_TERMINAL_NUMBER'),
			'Currency' => Configuration::get('REDSYS_CURRENCY'),
			'PayMethods' => Configuration::get('REDSYS_PAYMENT_TYPE'),
			'frameWidth' => Configuration::get('REDSYS_IFRAME_WIDTH'),
			'url_IPN' => $this->module->getMerchantURL(),
			'url_OK' => $urlOK,
			'url_NOK' => $urlNOK,
			'Firma' => $this->module->getFirma($orderId, $amount),
			'orderId' => $orderId,
			'Amount' => $amount,
			'locale' => $locale,
			'tpvLang' => $tpvLang,
			'cart_products' => $cartProducts,
			'showInIframe' => (Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1),
			'data' => $idCart.'##'.$secureKey,
			'ps_module_dir' => _PS_MODULE_DIR_
		));

		$this->context->smarty->caching = false;
		Tools::clearCache($this->context->smarty);

		$this->setTemplate('redirect.tpl');
	}
}
