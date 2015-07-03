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

class RedsysResultModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$result = (int)Tools::getValue('result');
		$cartId = (int)Tools::getValue('cartId');

		if ($result == 0)
		{
			$orderId = Order::getOrderByCartId($cartId);
			$order = new Order($orderId);
			$customer = new Customer($order->id_customer);

			Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cartId.
			'&id_module='.$this->module->id.'&id_order='.$orderId.'&key='.$customer->secure_key);
		}
		else
		{
			$this->context->smarty->assign(array(
				'module_dir' => _MODULE_DIR_.$this->module->name,
				'ps_module_dir' => _PS_MODULE_DIR_,
				'clear_cart' => (int)Configuration::get('REDSYS_CLEAR_CART')
			));

			$this->setTemplate('resultErr.tpl');
		}
	}
}
