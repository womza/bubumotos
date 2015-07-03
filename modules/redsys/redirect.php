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

$useSSL = true;

include(dirname(__FILE__).'/../../config/config.inc.php');
include(_PS_ROOT_DIR_.'/header.php');
include_once(dirname(__FILE__).'/redsys.php');

$redsys = new Redsys();

if ($only_used_ps14 = false)
	$smarty = new Smarty();

if ($only_used_ps14 = false)
	$cookie = new Cookie();

$cart = new Cart((int)$cookie->id_cart);
$idCart = (int)$cookie->id_cart;
$secureKey = $cart->secure_key;
$products = $cart->getProducts();
$locale = Language::getIsoById($cookie->id_lang);
$sandbox_mode = Configuration::get('REDSYS_SANDBOX');

if ($sandbox_mode == '1')
	$url_tpvv = 'https://sis-t.redsys.es:25443/sis/realizarPago';
else
	$url_tpvv = 'https://sis.redsys.es/sis/realizarPago';

/*Language Virtual POS*/
$tpvLang = '1';
switch ($locale)
{
	case 'es':
		$tpvLang = '1';
		break;
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

$amount = (float)$cart->getOrderTotal(true, Cart::BOTH) * 100;
$urlOK = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.
		'modules/redsys/resultRedirect.php?result=0&cartId='.$idCart.
		(Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1?'&content_only=1':'');
$urlNOK = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.
		'modules/redsys/resultRedirect.php?result=1&cartId='.$idCart.
		(Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1?'&content_only=1':'');

$orderId = date('ymdHis');

$smarty->assign(array(
	'link' => new Link(),
	'tpl_dir' => _PS_THEME_DIR_,
	'id_cart' => $idCart,
	'url_tpvv' => $url_tpvv,
	'MerchantCode' => Configuration::get('REDSYS_MERCHANT_CODE'),
	'MerchantName' => Configuration::get('REDSYS_MERCHANT_NAME'),
	'TerminalNum' => Configuration::get('REDSYS_TERMINAL_NUMBER'),
	'Currency' => Configuration::get('REDSYS_CURRENCY'),
	'PayMethods' => Configuration::get('REDSYS_PAYMENT_TYPE'),
	'frameWidth' => Configuration::get('REDSYS_IFRAME_WIDTH'),
	'url_IPN' => Redsys::getMerchantURL(),
	'url_OK' => $urlOK,
	'url_NOK' => $urlNOK,
	'Firma' => Redsys::getFirma($orderId, $amount),
	'orderId' => $orderId,
	'Amount' => $amount,
	'locale' => $locale,
	'tpvLang' => $tpvLang,
	'cart_products' => $cartProducts,
	'showInIframe' => (Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1),
	'data' => $idCart.'##'.$secureKey
));

$smarty->display(_PS_MODULE_DIR_.$redsys->name.'/views/templates/front/redirect.tpl');
