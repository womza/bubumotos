{*
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
 *}
{capture name=path}<a href="{$link->getPageLink('order.php', true)}">{l s='Your shopping cart' mod='redsys'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Credit card payment' mod='redsys'}{/capture}
<p>&nbsp;</p>
<br/>
<div class="pasatDiv">
	<div class="passatBody">
		<div class="separador"></div>
		<iframe src="" name="tpv" width="{$frameWidth|escape:'htmlall':'UTF-8'}" height="650" scrolling="auto" frameborder="0" transparency>
			<p>{l s='Your browser does not support iframes.' mod='redsys'}</p>
		</iframe>
		<form action="{$url_tpvv}" name="compra" method="post" enctype="application/xwww-form-urlencoded" {if $showInIframe}target="tpv"{/if}>
			<input name="Ds_Merchant_MerchantCode" type="hidden" value="{$MerchantCode|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_MerchantName" type="hidden" value="{$MerchantName|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_Terminal" type="hidden" value="{$TerminalNum|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_MerchantURL" type="hidden" value="{$url_IPN|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_UrlOK" type="hidden" value="{$url_OK|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_UrlKO" type="hidden" value="{$url_NOK|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_MerchantSignature" type="hidden" value="{$Firma|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="DS_Merchant_TransactionType" type="hidden" value="0" autocomplete="off">
			<input name="Ds_Merchant_Order" type="hidden" value="{$orderId|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_Amount" type="hidden" value="{$Amount|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_Currency" type="hidden" value="{$Currency|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_PayMethods" type="hidden" value="{$PayMethods|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_ConsumerLanguage" type="hidden" value="{$tpvLang|escape:'htmlall':'UTF-8'}" autocomplete="off">
			<input name="Ds_Merchant_MerchantData" type="hidden" value="{$data|escape:'htmlall':'UTF-8'}" autocomplete="off">
		</form>
		<script>document.compra.submit();</script>
	</div>
</div>
<p><a href="javascript:history.go(-1);">{l s='Go back' mod='redsys'}</a>
<div class="clear"></div>
