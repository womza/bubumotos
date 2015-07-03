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

$redsys = new Redsys();

if ($only_used_ps14 = false)
	$smarty = new Smarty();

$result = Tools::getValue('result');
$cartId = Tools::getValue('cartId');
$domain = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__;

if (version_compare(_PS_VERSION_, '1.5', '>'))
{
	$link = new Link();
	$url = $link->getModuleLink('redsys', 'result', array('result' => $result, 'cartId' => $cartId));
}
else
	$url = $domain.'modules/redsys/result.php?result='.$result.'&cartId='.$cartId;

$smarty->assign(array(
	'url' => $url
));

$smarty->display(_PS_MODULE_DIR_.$redsys->name.'/views/templates/front/resultRedirect.tpl');

?>