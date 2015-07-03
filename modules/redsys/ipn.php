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

include(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/redsys.php');

$merchantCode = Tools::getValue('Ds_MerchantCode');
$terminalNum = Tools::getValue('Ds_Terminal');
$tpvOrderId = Tools::getValue('Ds_Order');
$amount = Tools::getValue('Ds_Amount');
$currency = Tools::getValue('Ds_Currency');
$firma = Tools::getValue('Ds_Signature');
$data = Tools::getValue('Ds_MerchantData');
$responseCode = Tools::getValue('Ds_Response');
$errorCode = 'No errors';
if (Tools::getIsset('Ds_ErrorCode'))
	$errorCode = Tools::getValue('Ds_ErrorCode');

$ownFirma = Redsys::getFirmaIPN($amount, $tpvOrderId, $merchantCode, $currency, $responseCode);

$mensaje = "DATOS RELEVANTES\n";
$mensaje .= "Precio: $amount\n";
$mensaje .= "Order: $tpvOrderId\n";
$mensaje .= "Codigo Comercio: $merchantCode\n";
$mensaje .= "Moneda: $currency\n";
$mensaje .= "Codigo Respuesta: $responseCode\n";
$mensaje .= "Data: $data\n";
$mensaje .= "Firma Servidor: $firma\n";
$mensaje .= "Firma Nuestra: $ownFirma\n";
$mensaje .= "Terminal: $terminalNum\n";
$mensaje .= "Error Code: $errorCode\n";

if ($firma != $ownFirma)
	die('Firmas does not match');

if ($merchantCode != Configuration::get('REDSYS_MERCHANT_CODE'))
	die('MerchantCode does not match');

if ($terminalNum != Configuration::get('REDSYS_TERMINAL_NUMBER'))
	die('Terminal Num. does not match');

if (!$tpvOrderId)
	die('Transaction with no order id');

if (!$data)
	die('Transaction with no data');

$arrayData = preg_split('/##/', $data, -1);
if (count($arrayData) != 2)
	die('Transaction with incorrect data');
/*FIN VALIDACIONES*/

$cartId = $arrayData[0];
$secure_key = $arrayData[1];
$cart = new Cart((int)$cartId);

$redsys = new Redsys();

$codigoRespPre = Tools::substr($responseCode, 0, 2);
$codigoError = Tools::substr($responseCode, 1, 3);

if (version_compare(_PS_VERSION_, '1.5', '>'))
{
	if (Context::getContext()->link == null)
		Context::getContext()->link = new Link();

	Context::getContext()->currency = new Currency($cart->id_currency);
	Context::getContext()->customer = new Customer($cart->id_customer);
	Context::getContext()->cart = $cart;
}

/* ADD TO NOTIFYICATION TABLE */

$transaction_info = 'GET: '.http_build_query($_GET);
$transaction_info .= ' | ';
$transaction_info .= 'POST: '.http_build_query($_POST);
$type = Configuration::get('REDSYS_SANDBOX')?'test':'real';

$errorMessages = array();
include(dirname(__FILE__).'/errorMessages.php');
if (array_key_exists($codigoError, $errorMessages))
	$errorMessage = $errorMessages[$codigoError];
else
	$errorMessage = 'Transacción denegada.';

if ($codigoRespPre == '00')
	$errorMessage = 'Pago OK';

$notifyErrorCode = $responseCode;
if ($errorCode != 'No errors')
{
	$notifyErrorCode .= '-'.$errorCode;

	if (array_key_exists($errorCode, $errorMessages))
		$errorMessage .= ' - '.$errorMessages[$errorCode];
}

$insertNotifySql = 'INSERT INTO `'.pSQL(_DB_PREFIX_.$redsys->name).'_notify` (
    `id_customer`, `id_cart`, `amount_cart`, `amount_paid`, `tpv_order`,
	`error_code`, `error_message`, `debug_data`, `type`, `date_add` ) VALUES (
    \''.(int)$cart->id_customer.'\', \''.pSQL($cartId).'\', \''.((float)$cart->getOrderTotal(true, Cart::BOTH)).'\', \''.((float)$amount / 100).'\', \''.pSQL($tpvOrderId).'\',
    \''.pSQL($notifyErrorCode).'\', \''.pSQL($errorMessage).'\', \''.pSQL($transaction_info).'\', \''.pSQL($type).'\', \''.date('Y-m-d H:i:s').'\'
	)';

Db::getInstance()->execute($insertNotifySql);
$notifyId = (int)Db::getInstance()->Insert_ID();

/* END ADD TO NOTIFICATION TABLE */

if ($codigoRespPre != '00' && Configuration::get('REDSYS_CLEAR_CART') == '1') /*ERROR*/
	$redsys->validateOrder((int)$cartId, _PS_OS_ERROR_, 0, $redsys->displayName, $mensaje, array(), null, false, $secure_key);
else if ($codigoRespPre == '00') /*OK*/
	$redsys->validateOrder((int)$cartId, _PS_OS_PAYMENT_, (int)$amount / 100, $redsys->displayName, $mensaje, array(), null, false, $secure_key);

if ($redsys->currentOrder)
{
	$sqlUpdate = 'UPDATE `'.pSQL(_DB_PREFIX_.$redsys->name).'_notify` SET `id_order` = '.(int)$redsys->currentOrder.
				' WHERE `id_'.$redsys->name.'_notify` = '.(int)$notifyId;
	Db::getInstance()->execute($sqlUpdate);
}

?>