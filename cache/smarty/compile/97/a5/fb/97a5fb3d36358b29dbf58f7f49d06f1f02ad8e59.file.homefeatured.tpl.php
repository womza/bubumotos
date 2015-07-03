<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:48:24
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/homefeatured/homefeatured.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1825398531556657c8e9d3c3-94665804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97a5fb3d36358b29dbf58f7f49d06f1f02ad8e59' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/homefeatured/homefeatured.tpl',
      1 => 1428622221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1825398531556657c8e9d3c3-94665804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'products' => 0,
    'active_ul' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556657c8ec3a12_48641712',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556657c8ec3a12_48641712')) {function content_556657c8ec3a12_48641712($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/usr/home/bubumotos.com/web/ps/tools/smarty/plugins/function.counter.php';
?><?php echo smarty_function_counter(array('name'=>'active_ul','assign'=>'active_ul'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['products']->value)&&$_smarty_tpl->tpl_vars['products']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('class'=>'homefeatured tab-pane','id'=>'homefeatured','active'=>$_smarty_tpl->tpl_vars['active_ul']->value), 0);?>

<?php } else { ?>
    <ul id="homefeatured" class="homefeatured tab-pane<?php if (isset($_smarty_tpl->tpl_vars['active_ul']->value)&&$_smarty_tpl->tpl_vars['active_ul']->value==1) {?> active<?php }?>">
        <li class="alert alert-info"><?php echo smartyTranslate(array('s'=>'No featured products at this time.','mod'=>'homefeatured'),$_smarty_tpl);?>
</li>
    </ul>
<?php }?><?php }} ?>
