<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:48:24
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockbestsellers/tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:577851192556657c8dcc146-36621318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d85b84daf9a6f5f09b3634117f1b671330a9715' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockbestsellers/tab.tpl',
      1 => 1428622221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '577851192556657c8dcc146-36621318',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'active_li' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556657c8dde788_71399147',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556657c8dde788_71399147')) {function content_556657c8dde788_71399147($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/usr/home/bubumotos.com/web/ps/tools/smarty/plugins/function.counter.php';
?><?php echo smarty_function_counter(array('name'=>'active_li','assign'=>'active_li'),$_smarty_tpl);?>

<li<?php if ($_smarty_tpl->tpl_vars['active_li']->value==1) {?> class="active"<?php }?>>
	<a data-toggle="tab" href="#blockbestsellers" class="blockbestsellers" title="<?php echo smartyTranslate(array('s'=>'Best Sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Best Sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</a>
</li><?php }} ?>
