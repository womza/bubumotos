<?php

class bubumotosuserModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        $customers = Customer::getCustomers();
        foreach ($customers as $c) {
            // avoid that admin changes the psw
            if ((int)$c['id_customer'] > 1) {
                $customer = Customer::getByEmail($c['email']);
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
                    /*if (Mail::Send($this->context->language->id, 'password', Mail::l('Your new password'), $mail_params, $customer->email, $customer->firstname.' '.$customer->lastname))
                        $this->context->smarty->assign(array('confirmation' => 1, 'customer_email' => $customer->email));
                    else
                        $this->errors[] = Tools::displayError('An error occurred while sending the email.');*/
                }
            }
        }

        die;
    }
}
