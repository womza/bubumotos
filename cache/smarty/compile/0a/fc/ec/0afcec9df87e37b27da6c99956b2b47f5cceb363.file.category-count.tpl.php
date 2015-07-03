<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:24:17
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81595505655665221dcf7e4-56778439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0afcec9df87e37b27da6c99956b2b47f5cceb363' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/category-count.tpl',
      1 => 1428622222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81595505655665221dcf7e4-56778439',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55665221df3f09_04633525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55665221df3f09_04633525')) {function content_55665221df3f09_04633525($_smarty_tpl) {?><span class="heading-counter"><?php if ($_smarty_tpl->tpl_vars['category']->value->id==1||$_smarty_tpl->tpl_vars['nb_products']->value==0) {?><?php echo smartyTranslate(array('s'=>'There are no products in  this category'),$_smarty_tpl);?>
<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['nb_products']->value==1) {?><?php echo smartyTranslate(array('s'=>'There is %d product.','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'There are %d products.','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }?><?php }?></span><?php }} ?>
