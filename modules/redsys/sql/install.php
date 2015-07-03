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

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_notify` (
    `id_'.pSQL($this->name).'_notify` int(11) NOT NULL AUTO_INCREMENT,
    `id_customer` int(11) NOT NULL,
    `id_cart` int(11) NOT NULL,
    `id_order` int(11) DEFAULT 0,
    `tpv_order` varchar(25) NOT NULL,
    `amount_cart` decimal(11,2) NOT NULL,
    `amount_paid` decimal(11,2) NOT NULL,
    `amount_refunded` decimal(11,2) NOT NULL DEFAULT 0,
    `error_code` varchar(25) NOT NULL,
    `error_message` varchar(450) NOT NULL,
    `debug_data` TEXT,
    `type` ENUM( \'test\', \'real\', \'unknown\' ) NOT NULL DEFAULT \'unknown\',
    `date_add` datetime NOT NULL,
    PRIMARY KEY  (`id_'.pSQL($this->name).'_notify`)
) ENGINE='.pSQL(_MYSQL_ENGINE_).' DEFAULT CHARSET=utf8;';

$sql[] = 'INSERT INTO `'.pSQL(_DB_PREFIX_.$this->name).'_notify` (`id_customer`, `id_cart`,`id_order`,`tpv_order`,
		`amount_cart`, `amount_paid`, `error_code`, `error_message`, `debug_data`, `type`, `date_add`)
		  VALUES (1, 1, 0, "0", 0,0, "TEST", "TEST", "TEST", "test", NOW() )';


foreach ($sql as $query)
	if (Db::getInstance()->execute($query) == false)
		return false;
