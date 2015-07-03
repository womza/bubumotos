<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:32:07
         compiled from "/usr/home/bubumotos.com/web/ps/modules/paypal/views/templates/hook/column.tpl" */ ?>
<?php /*%%SmartyHeaderCode:743171903556653f7bb9e77-69978985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd61462880f08eaa6de6cdbbda37b85a07e58754c' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/modules/paypal/views/templates/hook/column.tpl',
      1 => 1432051772,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '743171903556653f7bb9e77-69978985',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir_ssl' => 0,
    'logo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556653f7bccc78_74812540',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556653f7bccc78_74812540')) {function content_556653f7bccc78_74812540($_smarty_tpl) {?>

<div id="paypal-column-block">
	<p><a href="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/paypal/about.php" rel="nofollow"><img src="<?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
" alt="PayPal" title="<?php echo smartyTranslate(array('s'=>'Pay with PayPal','mod'=>'paypal'),$_smarty_tpl);?>
" style="max-width: 100%" /></a></p>
</div>
<?php }} ?>
