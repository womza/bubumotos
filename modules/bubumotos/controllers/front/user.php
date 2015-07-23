<?php

class bubumotosuserModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        $customers = Customer::getCustomers();
        foreach ($customers as $c) {
            // avoid that admin changes the psw
            if ((int)$c['id_customer'] > 1) {
                $customer = new Customer();
                $customer->getByemail($c['email']);
                $customer->passwd = Tools::encrypt($password = Tools::passwdGen(MIN_PASSWD_LENGTH));
                $customer->last_passwd_gen = date('Y-m-d H:i:s', time());
                // send email with the new password to each customer
                if ($customer->update())
                {
                    Hook::exec('actionPasswordRenew', array('customer' => $customer, 'password' => $password));
                    $mail_params = array(
                        '{email}' => $customer->email,
                        '{lastname}' => $customer->lastname,
                        '{firstname}' => $customer->firstname,
                        '{passwd}' => $password
                    );
                    Mail::Send((int)Configuration::get('PS_LANG_DEFAULT'), 'bubumotos_psw', Mail::l('Your new password', (int)Configuration::get('PS_LANG_DEFAULT')), $mail_params, $customer->email, $customer->firstname.' '.$customer->lastname, null, null, null, null, dirname(__FILE__).'/../../mails/', false, Context::getContext()->shop->id);
                }
            }
        }

        die;
    }
}
