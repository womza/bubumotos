<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:48:24
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockbestsellers/blockbestsellers-home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1805094736556657c8ecdb78-90935995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a625eee82ec9ba36c81d9526f851d5ef9298cf12' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockbestsellers/blockbestsellers-home.tpl',
      1 => 1428622221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1805094736556657c8ecdb78-90935995',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'best_sellers' => 0,
    'active_ul' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556657c8ef6ae2_24690650',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556657c8ef6ae2_24690650')) {function content_556657c8ef6ae2_24690650($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/usr/home/bubumotos.com/web/ps/tools/smarty/plugins/function.counter.php';
?><?php echo smarty_function_counter(array('name'=>'active_ul','assign'=>'active_ul'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['best_sellers']->value)&&$_smarty_tpl->tpl_vars['best_sellers']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['best_sellers']->value,'class'=>'blockbestsellers tab-pane','id'=>'blockbestsellers','active'=>$_smarty_tpl->tpl_vars['active_ul']->value), 0);?>

<?php } else { ?>
	<ul id="blockbestsellers" class="blockbestsellers tab-pane<?php if (isset($_smarty_tpl->tpl_vars['active_ul']->value)&&$_smarty_tpl->tpl_vars['active_ul']->value==1) {?> active<?php }?>">
		<li class="alert alert-info"><?php echo smartyTranslate(array('s'=>'No best sellers at this time.','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</li>
	</ul>
<?php }?><?php }} ?>
