<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 03:25:06
         compiled from "/usr/home/bubumotos.com/web/ps/modules/blockcategories/views/blockcategories_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195432441355666e72851254-11628088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06cdd6f21afdea60814764be6d732eeac3c7fe02' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/modules/blockcategories/views/blockcategories_admin.tpl',
      1 => 1431970921,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195432441355666e72851254-11628088',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55666e7285ebc2_79236308',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55666e7285ebc2_79236308')) {function content_55666e7285ebc2_79236308($_smarty_tpl) {?>
<div class="form-group">
	<label class="control-label col-lg-3">
		<span class="label-tooltip" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo smartyTranslate(array('s'=>'You can upload a maximum of 3 images.','mod'=>'blockcategories'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Thumbnails','mod'=>'blockcategories'),$_smarty_tpl);?>

		</span>
	</label>
	<div class="col-lg-4">
		<?php echo $_smarty_tpl->tpl_vars['helper']->value;?>

	</div>
</div>
<?php }} ?>
