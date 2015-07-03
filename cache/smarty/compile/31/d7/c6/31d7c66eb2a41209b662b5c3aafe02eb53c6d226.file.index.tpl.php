<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:32:08
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1259975379556653f86a6924-86722529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31d7c66eb2a41209b662b5c3aafe02eb53c6d226' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/index.tpl',
      1 => 1428622222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1259975379556653f86a6924-86722529',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HOOK_HOME_TAB_CONTENT' => 0,
    'HOOK_HOME_TAB' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556653f86c5612_96224410',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556653f86c5612_96224410')) {function content_556653f86c5612_96224410($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
        <ul id="home-page-tabs" class="nav nav-tabs clearfix">
			<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

		</ul>
	<?php }?>
	<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
<?php }?>

<?php }} ?>
