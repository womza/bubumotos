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

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class Redsys extends PaymentModule
{
	public function __construct()
	{
		$this->name = 'redsys';
		$this->tab = 'payments_gateways';
		$this->version = '4.1.1';
		$this->author = 'OBSolutions.es';
		$this->module_key = 'b1b32a623a92cff442dfacac6654e86b';

		$this->elemsPerPage = 10;

		parent::__construct();

		if (version_compare(_PS_VERSION_, '1.6', '<'))
			$this->bootstrap = false;
		else
			$this->bootstrap = true;

		$this->_errors = array();

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Credit card via Banco Sabadell/ServiRed TPV');
		$this->description = $this->l('Accepts payments by Banco Sabadell/ServiRed TPV Virtual.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');

		/* Backward compatibility */
		if (version_compare(_PS_VERSION_, '1.5', '<'))
			require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');

	}

	public function install()
	{
		include(dirname(__FILE__).'/sql/install.php');

		if (!parent::install() || !$this->registerHook('payment') || !$this->registerHook('paymentReturn') || !$this->registerHook('header'))
			return false;


		if (version_compare(_PS_VERSION_, '1.5', '<'))
			$this->registerHook('adminOrder');
		else
			$this->registerHook('displayAdminOrder');


		Configuration::updateValue('REDSYS_SANDBOX', '1');
		Configuration::updateValue('REDSYS_MERCHANT_CODE', '');
		Configuration::updateValue('REDSYS_MERCHANT_NAME', '');
		Configuration::updateValue('REDSYS_TERMINAL_NUMBER', '1');
		Configuration::updateValue('REDSYS_MERCHANT_KEY', '');
		Configuration::updateValue('REDSYS_SHOW_AS_IFRAME', '1');
		Configuration::updateValue('REDSYS_CURRENCY', '978');
		Configuration::updateValue('REDSYS_IFRAME_WIDTH', '100%');
		Configuration::updateValue('REDSYS_CLEAR_CART', '1');
		Configuration::updateValue('REDSYS_PAYMENT_TYPE', 'C');

		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall())
			return false;

		include(dirname(__FILE__).'/sql/uninstall.php');

		/* Clean configuration table */
		Configuration::deleteByName('REDSYS_SANDBOX');
		Configuration::deleteByName('REDSYS_MERCHANT_CODE');
		Configuration::deleteByName('REDSYS_MERCHANT_NAME');
		Configuration::deleteByName('REDSYS_TERMINAL_NUMBER');
		Configuration::deleteByName('REDSYS_MERCHANT_KEY');
		Configuration::deleteByName('REDSYS_SHOW_AS_IFRAME');
		Configuration::deleteByName('REDSYS_CURRENCY');
		Configuration::deleteByName('REDSYS_IFRAME_WIDTH');
		Configuration::deleteByName('REDSYS_CLEAR_CART');
		Configuration::deleteByName('REDSYS_PAYMENT_TYPE');

		return true;
	}

	public function getContent()
	{
		$output = '';
		/* update params */

		if (Tools::getIsset('submitUpdate'))
		{
			if (Tools::getValue('redsys_merchant_code') == null)
				$this->_errors[] = $this->l('Indicate Merchant CODE information.');

			if (Tools::getValue('redsys_merchant_name') == null)
				$this->_errors[] = $this->l('Indicate Merchant NAME information.');

			if (Tools::getValue('redsys_terminal_number') == null)
				$this->_errors[] = $this->l('Indicate Terminal NUMBER information.');

			if (Tools::getValue('redsys_merchant_key') == null)
				$this->_errors[] = $this->l('Indicate Merchant Key information.');

			if (!count($this->_errors))
			{
				Configuration::updateValue('REDSYS_SANDBOX', (int)Tools::getValue('redsys_sandbox'));
				/* Roundabout to avoid Configuration::updateValue() is_numeric bug when numbers have zeros at the left side */ 
				Configuration::updateValue('REDSYS_MERCHANT_CODE', '1'.(Tools::getValue('redsys_merchant_code')));
				Configuration::updateValue('REDSYS_MERCHANT_CODE', (Tools::getValue('redsys_merchant_code')));
				Configuration::updateValue('REDSYS_MERCHANT_NAME', (Tools::getValue('redsys_merchant_name')));
				/* Roundabout to avoid Configuration::updateValue() is_numeric bug when numbers have zeros at the left side */
				Configuration::updateValue('REDSYS_TERMINAL_NUMBER', '1'.(Tools::getValue('redsys_terminal_number')));
				Configuration::updateValue('REDSYS_TERMINAL_NUMBER', (Tools::getValue('redsys_terminal_number')));
				Configuration::updateValue('REDSYS_MERCHANT_KEY', (Tools::getValue('redsys_merchant_key')));
				Configuration::updateValue('REDSYS_SHOW_AS_IFRAME', (Tools::getValue('redsys_show_as_iframe')));
				Configuration::updateValue('REDSYS_CURRENCY', (Tools::getValue('redsys_currency')));
				Configuration::updateValue('REDSYS_IFRAME_WIDTH', (Tools::getValue('redsys_iframe_width')));
				Configuration::updateValue('REDSYS_CLEAR_CART', (Tools::getValue('clear_cart')));
				Configuration::updateValue('REDSYS_PAYMENT_TYPE', (Tools::getValue('payment_type')));
				$output = $this->displayConfirmation($this->l('Settings updated'));

			}
			else
			{
				$error_msg = '';
				foreach ($this->_errors as $error)
					$error_msg .= $error.'<br />';
				$output = $this->displayError($error_msg);
			}

		}
		elseif (Tools::isSubmit('deleteredsys') && Tools::getIsset('id'))
		{
			if ($this->deleteNotifyElem(Tools::getValue('id')))
				Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
			else
				$output .= $this->showErrorMessage('Se ha producido un error al borrar el registro.');
		}
		if (version_compare(_PS_VERSION_, '1.6', '<'))
		{
			$output .= $this->getContent1415();
			$output .= $this->boFooter14();
		}
		else
		{
			$output .= $this->getContent16();
			$output .= $this->boFooter16();
		}

		return $output;
	}

	private function showErrorMessage($message)
	{
		$output = '<div class="alert alert-danger">
			<button data-dismiss="alert" class="close" type="button">×</button>
			'.$message.'
		</div>';
		return $output;
	}

	public function hookPayment($params)
	{
		if (!Configuration::get('REDSYS_MERCHANT_CODE') || !Configuration::get('REDSYS_MERCHANT_NAME') || !Configuration::get('REDSYS_TERMINAL_NUMBER') || !Configuration::get('REDSYS_MERCHANT_KEY') || !Configuration::get('REDSYS_CURRENCY'))
			return;

		$flag = false;
		$allowedCurrencies = $this->getCurrency((int)$params['cart']->id_currency);
		foreach ($allowedCurrencies as $allowedCurrency)
			if ($allowedCurrency['id_currency'] == $params['cart']->id_currency)
			{
				$flag = true;
				break;
			}

		if ($flag)
		{
			$this->context->smarty->assign(array(
			'module_dir' => _MODULE_DIR_,
			));

			$tpl = 'payment.tpl';
			if (version_compare(_PS_VERSION_, '1.5', '<'))
				$tpl = 'views/templates/hook/payment14.tpl';

			return $this->display(__FILE__, $tpl);
		}
	}

	public function hookPaymentReturn()
	{
		$link = $this->context->link;

		if (!$this->context->customer->isLogged())
			$orderLink = $link->getPageLink('guest-tracking.php', true);
		else
			$orderLink = $link->getPageLink('history.php', true);

		$this->context->smarty->assign(array(
			'order_link' => $orderLink,
			'module_dir' => _MODULE_DIR_.$this->name
		));

		return $this->display(__FILE__, 'views/templates/front/resultOK.tpl');
	}

	public function hookAdminOrder($params)
	{
		return $this->hookDisplayAdminOrder($params);
	}

	public function hookDisplayAdminOrder($params)
	{
		$refundResult = '';
		if (Tools::isSubmit('tpvRefundSubmit') && Tools::getIsset('refundNotificationId') && Tools::getIsset('refundAmount'))
		{
			$refundAmount = Tools::getValue('refundAmount');
			$refundAmount = str_replace(',', '.', $refundAmount);
			if(!Validate::isFloat($refundAmount))
				$refundResult = '<div class="alert alert-warning">'.$this->l('Refund amount is not valid.').'</div>';
			else {
				$refundResult = $this->_doRefund((int)Tools::getValue('refundNotificationId'), $refundAmount);
				$refundResult = '<div class="alert alert-warning">'.$refundResult.'</div>';
			}
		}

		$orderId = $params['id_order'];
		$cart = $params['cart'];
		if (!$cart)
		{
			$order = new Order($orderId);
			$cart = new Cart($order->id_cart);
		}
		$sql = '
			SELECT * FROM `'._DB_PREFIX_.$this->name.'_notify`
			WHERE `id_order` = '.$orderId.' && `id_cart` = '.$cart->id;//.' && error_code = \'0000\'';
		$sql .= ' ORDER BY date_add DESC';

		$res = Db::getInstance()->executeS($sql);

		if (is_array($res) && count($res) > 0)
		{
			$res = $res[0];

			if (version_compare(_PS_VERSION_, '1.6', '<'))
			{
				$langId = $this->context->language->id;
				$buttonClass = 'button';
				$htmlIni = '<br/><fieldset>
						<legend><img src="../img/admin/details.gif"> '.$this->l('Redsys POS info / refund').'</legend>';
				$htmlFin = '</fieldset>';
			}
			else
			{
				$langId = null;
				$buttonClass = 'btn btn-default';
				$htmlIni = '<div class="row"><div class="col-lg-12"><div class="panel">
						<h3><i class="icon-credit-card"></i> '.$this->l('Redsys POS info / refund').'</h3>';
				$htmlFin = '</div></div></div>';
			}

			$isError = $res['error_code'] != '0000';
			$canRefund = ($res['amount_paid'] > $res['amount_refunded']) && !$isError;

			$htmlContent = '<dl class="list-detail"><dt>'.$this->l('Redsys Order Identification').':</dt> <dd><span class="text-muted">'.$res['tpv_order'].'</span> <span class="badge badge-'.($res['type'] == 'real'?'success':'warning').'">'.$res['type'].'</span></dd>
						<dt>'.$this->l('Redsys Notification Date').':</dt> <dd><span class="text-muted">'.Tools::displayDate($res['date_add'], $langId, true).'</span></dd>';
			if (!$isError)
			{
				$htmlContent .= '<dt>'.$this->l('Amount paid').':</dt> <dd class="clearfix">
							<div><span style="width:100px;float:left;display:table;margin-top:5px;"><span class="badge badge-success">'.Tools::displayPrice($res['amount_paid']).'</span></span>'.($canRefund?' <a id="'.$this->name.'Refund" class="'.$buttonClass.'" style="margin-left: 10px;" data-tpv-notification-id="'.$res['id_'.$this->name.'_notify'].'">'.$this->l('Make a full refund').'</a>':'').'</div>
							'.($canRefund?'<div style="margin-top:10px;"><span class="input-group" style="width:100px; float:left;"><input type="text" id="amountToRefund" name="amountToRefund" value="0.0" style="text-align:right;" /><span class="input-group-addon">&euro;</span></span> <a data-tpv-notification-id="'.$res['id_'.$this->name.'_notify'].'" style="margin-left: 10px;" class="'.$buttonClass.'" id="'.$this->name.'PartialRefund">'.$this->l('Make a partial refund').'</a></div>':'').'
						</dd>
						<dt>'.$this->l('Amount refunded').':</dt> <dd><span class="badge badge-'.($res['amount_refunded'] > 0?'danger':'success').'">'.Tools::displayPrice($res['amount_refunded']).'</span></dd>';
			}
			else
				$htmlContent .= '<dt>'.$this->l('Amount paid').':</dt> <dd><span class="badge badge-danger">'.$this->l('Payment error').'</span></dd>';

			$htmlContent .= '<dt>'.$this->l('POS Message').':</dt> <dd>'.$res['error_code'].' - '.$res['error_message'].'</dd>
						<dt>'.$this->l('Redsys notification info').': <span id="viewNotificationMoreInfo" class="btn btn-default">'.$this->l('view more').'</span></dt> <dd id="notificationMoreInfo" style="display:none"><small>'.$res['debug_data'].'</small></dd></dl>';

			$refundForm = $javascript = '';
			if ($canRefund)
			{
				$refundForm = '<form action="" method="post" id="tpvRefundForm" name="tpvRefundForm">
								<input type="hidden" id="refundNotificationId" name="refundNotificationId" value="" />
								<input type="hidden" id="refundAmount" name="refundAmount" value="" />
								<input type="hidden" id="tpvRefundSubmit" name="tpvRefundSubmit" value="1" />
							</form>';

				$javascript = '<script>
							$(document).ready(function () {
								$(\'#'.$this->name.'Refund\').click(function() {
									notifId = $(this).data(\'tpv-notification-id\');
									if(confirm(\''.$this->l('Are you very sure you want to make a full refund? This operation is not reversible.').'\')) {
										$(\'#refundNotificationId\').val(notifId);
										$(\'#refundAmount\').val(0);
										$(\'#tpvRefundForm\').submit();
									} else return false;
								});
								$(\'#'.$this->name.'PartialRefund\').click(function() {
									notifId = $(this).data(\'tpv-notification-id\');
									if(confirm(\''.$this->l('Are you very sure you want to make a partial refund? This operation is not reversible.').'\')) {
										$(\'#refundNotificationId\').val(notifId);
										$(\'#refundAmount\').val($(\'#amountToRefund\').val());
										$(\'#tpvRefundForm\').submit();
									} else return false;
								});
							});
						</script>';
			}
			$javascript .= '<script>
							$(document).ready(function () {
								$(\'#viewNotificationMoreInfo\').click(function() {
									$(\'#notificationMoreInfo\').toggle();
								});
							});
						</script>';

			return $refundResult.$htmlIni.$htmlContent.$htmlFin.$refundForm.$javascript;
		}
	}

	public function hookHeader()
	{
		$metas = '';
		if (Tools::getValue('module') == 'redsys' || preg_match('/redirect.php/', $_SERVER['SCRIPT_NAME']))
			$metas = '<meta http-equiv="Expires" content="0">
	    		  <meta http-equiv="Last-Modified" content="0">
	    		  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	    		  <meta http-equiv="Pragma" content="no-cache">';

		return $metas;
	}

	private static function getCryptKey()
	{
			return Configuration::get('REDSYS_MERCHANT_KEY');
	}

	public static function getMerchantURL()
	{
		return Tools::getShopDomain(true, true).__PS_BASE_URI__.'modules/redsys/ipn.php';
	}

	public function getMerchantURLP()
	{
		return self::getMerchantURL();
	}

	public static function getFirma($orderId, $importe, $isRefund = false)
	{
		/*Ds_Merchant_Amount+Ds_Merchant_Order + Ds_Merchant_MerchantCode + DS_Merchant_Currency + Ds_Merchant_TransactionType + Ds_Merchant_MerchantURL + CLAU SECRETA*/

		$cryptKey = self::getCryptKey();
		$merchantCode = Configuration::get('REDSYS_MERCHANT_CODE');
		$curreny = Configuration::get('REDSYS_CURRENCY');
		$transactionType = '0';
		if ($isRefund)
			$transactionType = '3';
		$merchantURL = self::getMerchantURL();

		return Tools::strtoupper(sha1($importe.$orderId.$merchantCode.$curreny.$transactionType.($isRefund?'':$merchantURL).$cryptKey));
	}

	public static function getFirmaIPN($amount, $orderId, $merchantCode, $currency, $responseCode)
	{
		/*Ds_ Amount + Ds_ Order + Ds_MerchantCode + Ds_ Currency + Ds _Response + + CLAU SECRETA*/

		$cryptKey = self::getCryptKey();

		return Tools::strtoupper(sha1($amount.$orderId.$merchantCode.$currency.$responseCode.$cryptKey));
	}

	public function getFirmaIPNP($amount, $orderId, $merchantCode, $currency, $responseCode)
	{
		/*Ds_ Amount + Ds_ Order + Ds_MerchantCode + Ds_ Currency + Ds _Response + + CLAU SECRETA*/

		return self::getFirmaIPN($amount, $orderId, $merchantCode, $currency, $responseCode);
	}

	public function checkCurrency($cart)
	{
		$currency_order = new Currency((int)$cart->id_currency);
		$currencies_module = $this->getCurrency((int)$cart->id_currency);

		if (is_array($currencies_module))
			foreach ($currencies_module as $currency_module)
				if ($currency_order->id == $currency_module['id_currency'])
					return true;
		return false;
	}

	private function getContent1415()
	{
		/* display the module name */
		$output = '<h2>'.$this->displayName.' '.$this->version.'</h2>';

		$output .= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.$this->l('Virtual POS Settings').'</legend>
    				<div id="items">';

		$sandbox_mode = Configuration::get('REDSYS_SANDBOX');
		$sandbox_test = '';
		$sandbox_prod  = '';
		if ($sandbox_mode == '1')
			$sandbox_test = 'selected';
		else
			$sandbox_prod = 'selected';

		$output .= '
 	 			<div style="clear:both">
				<label>'.$this->l('Environment').'</label>
				<div class="margin-form" style="padding-left:0">
					<select name="redsys_sandbox" >
						<option value="1" '.$sandbox_test.'>'.$this->l('Test Simulator').'</option>
						<option value="0" '.$sandbox_prod.'>'.$this->l('Production').'</option>
					</select> &nbsp;'.$this->l('Remember that once in production may not return to the test').'
					<p style="clear: both"></p>
				</div>';
		$output .= '
 	 			<div style="clear:both">
					<label>'.$this->l('Merchant Code (FUC)').'</label>
					<div class="margin-form" style="padding-left:0">
						<input type="text" name="redsys_merchant_code" size="22" maxlength="9" value="'.Configuration::get('REDSYS_MERCHANT_CODE').'" />
						&nbsp;'.$this->l('Data provided by your bank').'
					</div>
				</div>
 	 			<div style="clear:both">
					<label>'.$this->l('Merchant Name').'</label>
					<div class="margin-form" style="padding-left:0">
						<input type="text" name="redsys_merchant_name" size="22" maxlength="25" value="'.Configuration::get('REDSYS_MERCHANT_NAME').'" />
						&nbsp;'.$this->l('Data to display in the form of payment').'
					</div>
				</div>
 	 			<div style="clear:both">
					<label>'.$this->l('Terminal number').'</label>
					<div class="margin-form" style="padding-left:0">
						<input type="text" name="redsys_terminal_number" size="22" maxlength="2" value="'.Configuration::get('REDSYS_TERMINAL_NUMBER').'" />
						&nbsp;'.$this->l('Data provided by your bank').'
					</div>
				</div>
 	 			<div style="clear:both">
					<label>'.$this->l('Merchant Encryption key').'</label>
					<div class="margin-form" style="padding-left:0">
						<input type="text" name="redsys_merchant_key" size="22" maxlength="25" value="'.Configuration::get('REDSYS_MERCHANT_KEY').'" />
						&nbsp;'.$this->l('Data provided by your bank').'
					</div>
				</div>
 	 			';
		$output .= '
				<div style="clear:both">
					<label>'.$this->l('Payment types accepted').'</label>
					<div class="margin-form" style="padding-left:0">
						<select name="payment_type" >
								<option value="C" '.(Configuration::get('REDSYS_PAYMENT_TYPE') == 'C'?'selected':'').'>'.$this->l('Only credit card').'</option>
								<option value="R" '.(Configuration::get('REDSYS_PAYMENT_TYPE') == 'R'?'selected':'').'>'.$this->l('Payment by Transfer (only if you have this payment method active)').'</option>
								<option value="D" '.(Configuration::get('REDSYS_PAYMENT_TYPE') == 'D'?'selected':'').'>'.$this->l('Debit (only if you have this payment method active)').'</option>
								<option value="T" '.(Configuration::get('REDSYS_PAYMENT_TYPE') == 'T'?'selected':'').'>'.$this->l('Credit card + IUPAY').'</option>
							</select>
					</div>
				<div style="clear:both">
					<label>'.$this->l('Currency').'</label>
					<div class="margin-form" style="padding-left:0">
						<select name="redsys_currency" >
								<option value="978" '.(Configuration::get('REDSYS_CURRENCY') == '978'?'selected':'').'>'.$this->l('Euro').'</option>
								<option value="840" '.(Configuration::get('REDSYS_CURRENCY') == '840'?'selected':'').'>'.$this->l('Dollar').'</option>
							</select>
					</div>
 	 		</div>
				</div>
				</fieldset>';

		/*$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);*/

		$output .= '<p style="clear: both"></p>';

		$output .= '<fieldset>
 	 	<legend><img src="../img/admin/manufacturers.gif" alt="" title="" /> '.$this->l('Advanced Settings').'</legend>

 	 	<div style="clear:both">
					<label>'.$this->l('Payment form style').'</label>
					<div class="margin-form" style="padding-left:0">
						<select name="redsys_show_as_iframe" >
							<option value="1" '.(Configuration::get('REDSYS_SHOW_AS_IFRAME') == 1?'selected':'').'>'.$this->l('iFrame / Integrated').'</option>
							<option value="0" '.(Configuration::get('REDSYS_SHOW_AS_IFRAME') != 1?'selected':'').'>'.$this->l('New Blank Page').'</option>
						</select>
						<p style="clear: both"></p>
					</div>
				</div>
		<div style="clear:both">
			<label>'.$this->l('iFrame Width').'</label>
			<div class="margin-form" style="padding-left:0">
				<input type="text" name="redsys_iframe_width" size="6" maxlength="3" value="'.Configuration::get('REDSYS_IFRAME_WIDTH').'" />
				&nbsp;'.$this->l('pixels (only for iFrame/Integrated option)').'
				<p style="clear: both"></p>
			</div>
		</div>

		<div style="clear:both">
			<label>'.$this->l('Clear the cart if fails to pay').' </label>
			        <div class="margin-form" style="padding-left:0">
			        	<label class="t" for="clear_cart_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Yes').'" title="'.$this->l('Yes').'" /></label>
						<input type="radio" name="clear_cart" id="clear_cart_on" value="1"'.(Configuration::get('REDSYS_CLEAR_CART') ? ' checked="checked"' : '').' />
						<label class="t" for="clear_cart_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('No').'" title="'.$this->l('No').'" style="margin-left: 10px;" /></label>
						<input type="radio" name="clear_cart" id="clear_cart_on" value="0" '.(!Configuration::get('REDSYS_CLEAR_CART') ? 'checked="checked"' : '').'/>
						&nbsp;'.$this->l('If you disable this option, the order will not be generated in state "Error in payment" and the cart will remain intact').'
			        </div>

 	 	</fieldset>';

		$output .= ' <div class="margin-form clear">
					<div class="clear pspace"></div>
					<div class="margin-form">
						 <input type="submit" name="submitUpdate" value="'.$this->l('Save').'" class="button" />
					</div>
				</div>
				</form>';

		return $output.'<fieldset><legend>'.$this->l('Bank Notifications').'</legend>'.$this->_getNotifications().'</fieldset><br/>';
	}

	private function getContent16()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Virtual POS Settings'),
					'icon' => 'icon-wrench'
				),
				'input' => array(
					array(
						'type' => 'select',
						'label' => $this->l('Environment'),
						'name' => 'redsys_sandbox',
						'options' => array(
						'query' => array(
							array(
								'id' => '1',
								'name' => $this->l('Test Simulator')),
							array(
								'id' => '0',
								'name' => $this->l('Production')),
						),
						'id' => 'id',
						'name' => 'name'
						),
					),

					array(
						'type' => 'text',
						'label' => $this->l('Merchant Code (FUC)'),
						'name' => 'redsys_merchant_code',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Merchant Name'),
						'name' => 'redsys_merchant_name',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Terminal number'),
						'name' => 'redsys_terminal_number',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Merchant Encryption key'),
						'name' => 'redsys_merchant_key',
					),
					array(
								'type' => 'select',
								'label' => $this->l('Payment types accepted'),
								'name' => 'payment_type',
								'options' => array(
										'query' => array(
												array(
														'id' => 'C',
														'name' => $this->l('Only credit card')),
												array(
														'id' => 'R',
														'name' => $this->l('Payment by Transfer (only if you have this payment method active)')),
												array(
														'id' => 'D',
														'name' => $this->l('Debit (only if you have this payment method active)')),
												array(
														'id' => 'T',
														'name' => $this->l('Credit card + IUPAY')),
										),
										'id' => 'id',
										'name' => 'name'
								),
					),
					array(
						'type' => 'select',
						'label' => $this->l('Currency'),
						'name' => 'redsys_currency',
						'options' => array(
						'query' => array(
							array(
								'id' => '978',
								'name' => $this->l('Euro')),
							array(
								'id' => '840',
								'name' => $this->l('Dollar')),
						),
						'id' => 'id',
						'name' => 'name'
						),
					),
					array(
						'type' => 'select',
						'label' => $this->l('Payment form style'),
						'name' => 'redsys_show_as_iframe',
						'options' => array(
						'query' => array(
							array(
								'id' => '1',
								'name' => $this->l('iFrame / Integrated')),
							array(
								'id' => '0',
								'name' => $this->l('New Blank Page')),
						),
						'id' => 'id',
						'name' => 'name'
						),
					),
					array(
						'type' => 'text',
						'label' => $this->l('iFrame Width'),
						'name' => 'redsys_iframe_width',
					'desc' => $this->l('pixels (only for iFrame/Integrated option)'),

					),
					array(
						'type' => 'switch',
						'label' => $this->l('Clear the cart if fails to pay'),
						'name' => 'clear_cart',
						'desc' => $this->l('If you disable this option, the order will not be generated in state "Error in payment" and the cart will remain intact'),
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'clear_cart_on',
								'value' => 1,
								'label' => $this->l('Enabled')
							),
							array(
								'id' => 'clear_cart_off',
								'value' => 0,
								'label' => $this->l('Disabled')
							)
						),
					)

				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->id = (int)Tools::getValue('id_carrier');
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitUpdate';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		$return = $helper->generateForm(array($fields_form));

		return $return.$this->_getNotifications();
	}

	private function _doRefund($notificationId, $refundQty = 0)
	{
		$sql = 'SELECT `id_'.$this->name.'_notify` as id, `id_customer`, `id_cart`, `id_order`, `amount_cart`, `amount_paid`,
					`amount_refunded`, `tpv_order`, `error_code`, `error_message`, `debug_data`, `type`, `date_add`
				FROM `'._DB_PREFIX_.$this->name.'_notify` WHERE `id_'.$this->name.'_notify` = '.(int)$notificationId;

		$notification = Db::getInstance()->getRow($sql);

		if (!$notification)
			return $this->l('No se ha encontrado la notificacion.');

		$notification['id_order'];

		$amountToRefund = $notification['amount_paid'] - $notification['amount_refunded'];

		if($refundQty > 0 && $refundQty < $amountToRefund)
			$amountToRefund = $refundQty;

		$postData = 'entrada=<DATOSENTRADA>
		<DS_Version>0.1</DS_Version>
		<DS_MERCHANT_CURRENCY>'.Configuration::get('REDSYS_CURRENCY').'</DS_MERCHANT_CURRENCY>
		<DS_MERCHANT_MERCHANTURL>'.$this->getMerchantURL().'</DS_MERCHANT_MERCHANTURL>
		<DS_MERCHANT_TRANSACTIONTYPE>3</DS_MERCHANT_TRANSACTIONTYPE>
		<DS_MERCHANT_MERCHANTDATA>'.$notification['id_cart'].'#'.$notification['id_order'].'</DS_MERCHANT_MERCHANTDATA>
		<DS_MERCHANT_AMOUNT>'.($amountToRefund * 100).'</DS_MERCHANT_AMOUNT>
		<DS_MERCHANT_MERCHANTNAME>'.Configuration::get('REDSYS_MERCHANT_NAME').'</DS_MERCHANT_MERCHANTNAME>
		<DS_MERCHANT_MERCHANTSIGNATURE>'.$this->getFirma($notification['tpv_order'], $amountToRefund * 100, true).'</DS_MERCHANT_MERCHANTSIGNATURE>
		<DS_MERCHANT_TERMINAL>'.Configuration::get('REDSYS_TERMINAL_NUMBER').'</DS_MERCHANT_TERMINAL>
		<DS_MERCHANT_MERCHANTCODE>'.Configuration::get('REDSYS_MERCHANT_CODE').'</DS_MERCHANT_MERCHANTCODE>
		<DS_MERCHANT_ORDER>'.$notification['tpv_order'].'</DS_MERCHANT_ORDER>
		</DATOSENTRADA>';

		$sandbox_mode = Configuration::get('REDSYS_SANDBOX');

		if ($sandbox_mode == '1')
			$url_tpvv = 'https://sis-t.redsys.es:25443/sis/operaciones';
		else
			$url_tpvv = 'https://sis.redsys.es/sis/operaciones';

		if (!function_exists('curl_init'))
			throw new Exception($this->name.' needs the CURL PHP extension.');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url_tpvv);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		if($server_output) {
			preg_match('/<codigo>(.*?)<\/codigo>/i', $server_output, $codigoError);
			$codigoError = $codigoError[1];
		} else
			$codigoError = -1;

		$errorMessage = 'OK';
		if ($codigoError != '0')
		{
			if($codigoError == -1)
				$errorMessage = curl_error($ch);
			else {
				$errorMessages = array();
				include(dirname(__FILE__).'/errorMessages.php');
				if (array_key_exists($codigoError, $errorMessages))
					$errorMessage = $errorMessages[$codigoError];
				else
					$errorMessage = 'Transacción denegada.';
			}
		}
		else
		{
			preg_match('/<operacion>(.*?)<\/operacion>/i', $server_output, $resultado);
			$resultado = $resultado[1];
			preg_match('/<ds_response>(.*?)<\/ds_response>/i', $resultado, $responseCode);
			$responseCode = $responseCode[1];

			if ($responseCode == '0900')
			{
				$sql = 'UPDATE `'._DB_PREFIX_.$this->name.'_notify`
						SET `amount_refunded` = `amount_refunded`+'.((float)$amountToRefund).'
						WHERE `id_'.$this->name.'_notify` = '.(int)$notificationId;
				Db::getInstance()->execute($sql);
				$errorMessage = 'Devolución realizada con éxito.';
			}
			else
			{
				$errorMessages = array();
				include(dirname(__FILE__).'/errorMessages.php');
				if (array_key_exists($responseCode, $errorMessages))
					$errorMessage = $errorMessages[$responseCode];
				else
					$errorMessage = 'Transacción denegada.';
			}
			$codigoError .= ' '.$responseCode;
		}

		curl_close ($ch);

		return $codigoError.' - '.$errorMessage;
	}

	private function _getNotifications()
	{
		$notifiesList = $this->getNotifies();

		$fields_list = array(
				'id_customer' => array(
						'title' => $this->l('Customer Id'),
						'type' => 'text',
				),
				'id_cart' => array(
						'title' => $this->l('Cart Id'),
						'type' => 'text',
				),
				'id_order' => array(
						'title' => $this->l('Order Id'),
						'type' => 'text',
				),
				'amount_paid' => array(
						'title' => $this->l('Amount Paid'),
						'type' => 'price',
				),
				'error_code' => array(
						'title' => $this->l('Error Code'),
						'type' => 'text',
				),
				'error_message' => array(
						'title' => $this->l('Message'),
						'type' => 'text',
				),
				'type' => array(
						'title' => $this->l('Type'),
						'type' => 'text',
				),
				'date_add' => array(
						'title' => $this->l('Date'),
						'type' => 'datetime',
				),
		);

		if (is_array($notifiesList) && count($notifiesList))
		{
			if (version_compare(_PS_VERSION_, '1.5', '<'))
			{
				$return = '<table class="table tableDnD" cellspacing="0" cellpadding="0"><tr>';
				foreach ($fields_list as $key => $field)
					$return .= '<th>'.$field['title'].'</th>';
				$return .= '</tr>';

				foreach ($notifiesList as $notify)
				{
					$return .= '<tr>';
					foreach ($fields_list as $key => $field)
						$return .= '<td>'.$notify[$key].'</td>';
					$return .= '</tr>';
				}

				$return .= '</table>';
			}
			else
			{
				$helper = new HelperList();
				$helper->shopLinkType = '';
				$helper->simple_header = true;
				$helper->identifier = 'id';
				$helper->actions = array('delete');
				$helper->show_toolbar = false;
				$helper->no_link = true;

				$helper->title = $this->l('Notifications list');
				$helper->table = $this->name;
				$helper->token = Tools::getAdminTokenLite('AdminModules');
				$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

				$return = $helper->generateList($notifiesList, $fields_list);

				$return .= $this->getPagination();
			}
		}
		else
			$return = $this->l('There is no notifications yet.');

		return $return;
	}

	private function getPagination()
	{
		$totalElems = $this->getTotalNotifies();
		$perPage = $this->elemsPerPage;
		$pages = ceil($totalElems / $perPage);
		$maxPagesToShowTop = 4;
		$maxPagesToShowBottom = 4;

		$pag = 1;
		if (Tools::getIsset('pag'))
			$pag = (int)Tools::getValue('pag', 1);

		$startToShowAtPage = $pag - $maxPagesToShowBottom;
		$endToShowAtPage = $pag + $maxPagesToShowTop;

		if ($endToShowAtPage > $pages)
			$endToShowAtPage = $pages;
		if ($startToShowAtPage < 1)
			$startToShowAtPage = 1;

		$output = '';
		if ($startToShowAtPage > 1)
			$output .= $this->_createPaginationLink(1).' .. ';

		for ($i = $startToShowAtPage; $i <= $endToShowAtPage; $i++)
			$output .= $this->_createPaginationLink($i, $pag != $i);

		if ($endToShowAtPage < $pages)
			$output .= ' .. '.$this->_createPaginationLink($pages);

		return '<div class="panel">'.$this->l('Page').': '.$output.'</div>';
	}

	private function _createPaginationLink($page, $isLinked = true)
	{
		$url = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&pag='.$page;

		return '<a '.($isLinked?'href="'.$url.'"':'disabled="disabled"').'  class="btn btn-default button" >'.$page.'</a>';
	}

	private function getTotalNotifies()
	{
		$sql = 'SELECT COUNT(\'\') as total
				FROM `'._DB_PREFIX_.$this->name.'_notify` ';
		return Db::getInstance()->getValue($sql);
	}

	private function getNotifies()
	{
		$result = array();
		$perPage = $this->elemsPerPage;

		$sql = 'SELECT `id_'.$this->name.'_notify` as id, `id_customer`, `id_cart`, `id_order`, `amount_cart`, `amount_paid`,
					`error_code`, `error_message`, `debug_data`, `type`, `date_add`
				FROM `'._DB_PREFIX_.$this->name.'_notify` ';
		$sql .= ' ORDER BY `date_add` DESC ';

		$pag = 0;
		if (Tools::getIsset('pag'))
			$pag = (int)Tools::getValue('pag', 1) - 1;

		$sql .= ' LIMIT '.($pag * $perPage).','.$perPage;

		if (!$notifies = Db::getInstance()->executeS($sql))
			return false;

		$i = 0;
		foreach ($notifies as $notify)
		{
			$result[$i] = $notify;

			$i++;
		}

		return $result;
	}

	public function deleteNotifyElem($notifyId)
	{
		$sql = 'DELETE FROM `'._DB_PREFIX_.$this->name.'_notify` WHERE `id_redsys_notify` = '.(int)$notifyId;
		return Db::getInstance()->execute($sql);
	}

	public function getConfigFieldsValues()
	{
		return array(
			'redsys_sandbox' => Tools::getValue('redsys_sandbox', Configuration::get('REDSYS_SANDBOX')),
			'redsys_merchant_code' => Tools::getValue('redsys_merchant_code', Configuration::get('REDSYS_MERCHANT_CODE')),
			'redsys_merchant_name' => Tools::getValue('redsys_merchant_name', Configuration::get('REDSYS_MERCHANT_NAME')),
			'redsys_terminal_number' => Tools::getValue('redsys_terminal_number', Configuration::get('REDSYS_TERMINAL_NUMBER')),
			'redsys_merchant_key' => Tools::getValue('redsys_merchant_key', Configuration::get('REDSYS_MERCHANT_KEY')),
			'redsys_currency' => Tools::getValue('redsys_currency', Configuration::get('REDSYS_CURRENCY')),
			'redsys_show_as_iframe' => Tools::getValue('redsys_show_as_iframe', Configuration::get('REDSYS_SHOW_AS_IFRAME')),
			'redsys_iframe_width' => Tools::getValue('redsys_iframe_width', Configuration::get('REDSYS_IFRAME_WIDTH')),
			'clear_cart' => Tools::getValue('clear_cart', Configuration::get('REDSYS_CLEAR_CART')),
			'payment_type' => Tools::getValue('payment_type', Configuration::get('REDSYS_PAYMENT_TYPE'))
		);
	}

	private function boFooter14()
	{
		$output = '';

		$output .= '<p style="clear: both"></p>
 	 	<fieldset style="width:450px; height:140px; float:left;">
 	 	<legend><img src="../img/admin/pdf.gif" alt="" title="" /> '.$this->l('Instructions').'</legend>';

		$locale = Language::getIsoById($this->context->cookie->id_lang);

		if ($locale == 'es' && $locale == 'ca' && $locale == 'gl')
			$locale = 'es';
		else
			$locale = 'en';

		$output .= '<p>'.$this->l('Check the instructions manual here').':';

		if (file_exists(dirname(__FILE__).'/docs/readme_en.pdf'))
			$output .= '<br/><br/> <a href="'.$this->_path.'docs/readme_en.pdf" target="_blank">'.$this->l('English version manual').'</a>';
		if (file_exists(dirname(__FILE__).'/docs/readme_es.pdf'))
			$output .= '<br/><br/> <a href="'.$this->_path.'docs/readme_es.pdf" target="_blank">'.$this->l('Spanish version manual').'</a>';

		$output .= '</p>
 	 	</fieldset>
 	 	<fieldset style="margin-left: 500px;">
 	 	<legend><img src="../img/admin/medal.png" alt="" title="" /> '.$this->l('Developed by').'</legend>';

		$output .= '
 	 	<div style="width: 330px; margin: 0 auto; padding:10px;">
 	 	<a href="http://addons.prestashop.com/'.$locale.'/65_obs-solutions" target="_blank"><img src="'.$this->_path.'views/img/logo.obsolutions.png" alt="'.$this->l('Developed by').' OBSolutions" title="'.$this->l('Developed by').' OBSolutions"/></a>
 	 	</div>
 	 	<p style="text-align:center"><a href="http://addons.prestashop.com/'.$locale.'/65_obs-solutions" target="_blank">'.$this->l('See all our modules on PrestaShop Addons clicking here').'</a></p>

 	 	</fieldset>
 	 	';

		return $output;
	}

	private function boFooter16()
	{
		$output = '';

		$output .= '<p style="clear: both"></p>
		<div class="panel" id="fieldset_0" style="width:500px; height:164px; float:left;">
             <div class="panel-heading">
                <img src="../img/admin/pdf.gif" alt="" title="" /> '.$this->l('Instructions').'
                        </div>
 	 	';

		$locale = Language::getIsoById($this->context->cookie->id_lang);

		if ($locale == 'es' && $locale == 'ca' && $locale == 'gl')
			$locale = 'es';
		else
			$locale = 'en';

		$output .= '<p>'.$this->l('Check the instructions manual here').':';

		if (file_exists(dirname(__FILE__).'/docs/readme_en.pdf'))
			$output .= '<br/><br/> <a href="'.$this->_path.'docs/readme_en.pdf" target="_blank">'.$this->l('English version manual').'</a>';
		if (file_exists(dirname(__FILE__).'/docs/readme_es.pdf'))
			$output .= '<br/><br/> <a href="'.$this->_path.'docs/readme_es.pdf" target="_blank">'.$this->l('Spanish version manual').'</a>';

		$output .= '</p>
 	 	</div>
 	 	<div class="panel" id="fieldset_0" style="margin-left: 520px;">
             <div class="panel-heading">
                <img src="../img/admin/medal.png" alt="" title="" /> '.$this->l('Developed by').'
                        </div>
 	 	';

		$output .= '
 	 	<div style="width: 330px; margin: 0 auto; padding:10px;">
 	 	<a href="http://addons.prestashop.com/'.$locale.'/65_obs-solutions" target="_blank"><img style="height:50px;" src="'.$this->_path.'views/img/logo.obsolutions.png" alt="'.$this->l('Developed by').' OBSolutions" title="'.$this->l('Developed by').' OBSolutions"/></a>
 	 	</div>
 	 	<p style="text-align:center"><a href="http://addons.prestashop.com/'.$locale.'/65_obs-solutions" target="_blank">'.$this->l('See all our modules on PrestaShop Addons clicking here').'</a></p>

 	 	</div>
 	 	';

		return $output;
	}
}