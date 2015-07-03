<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:32:07
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockbestsellers/tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:399550654556653f7cde557-49458063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '399550654556653f7cde557-49458063',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'active_li' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556653f7cf0c50_86552984',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556653f7cf0c50_86552984')) {function content_556653f7cf0c50_86552984($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/usr/home/bubumotos.com/web/ps/tools/smarty/plugins/function.counter.php';
?><?php echo smarty_function_counter(array('name'=>'active_li','assign'=>'active_li'),$_smarty_tpl);?>

<li<?php if ($_smarty_tpl->tpl_vars['active_li']->value==1) {?> class="active"<?php }?>>
	<a data-toggle="tab" href="#blockbestsellers" class="blockbestsellers" title="<?php echo smartyTranslate(array('s'=>'Best Sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Best Sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</a>
</li><?php }} ?>
