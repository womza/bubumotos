<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:19:42
         compiled from "/usr/home/bubumotos.com/web/ps/admin738/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17353867485566510ecb6cc4-89902477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '929b43721671153d8cccf9063e246fdd0bb0a96c' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/admin738/themes/default/template/content.tpl',
      1 => 1420621554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17353867485566510ecb6cc4-89902477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5566510ecc4684_15901869',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5566510ecc4684_15901869')) {function content_5566510ecc4684_15901869($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
