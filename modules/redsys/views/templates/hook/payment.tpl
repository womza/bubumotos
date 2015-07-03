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
<div class="row">
	<div class="col-xs-12 col-md-12">
		<p class="payment_module">
			<a href="{$link->getModuleLink('redsys', 'payment', [], true)|escape:'htmlall':'UTF-8'}"
					title="{l s='Pay with your VISA / MasterCard / 4B' mod='redsys'}"
					style="background:url('{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/redsys/views/img/payment.jpg') no-repeat scroll 15px 15px transparent">
				{l s='Pay with your VISA / MasterCard / 4B' mod='redsys'}
			</a>
		</p>
	</div>
</div>