<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:48:24
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockfacebook/blockfacebook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1699128747556657c8d17751-87889875%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee59740479f9d79f3486b70edeece60434ee582b' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockfacebook/blockfacebook.tpl',
      1 => 1428622221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1699128747556657c8d17751-87889875',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'facebookurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556657c8d29291_90589351',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556657c8d29291_90589351')) {function content_556657c8d29291_90589351($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['facebookurl']->value!='') {?>
<div id="fb-root"></div>
<div id="facebook_block" class="col-xs-4">
	<h4 ><?php echo smartyTranslate(array('s'=>'Follow us on facebook','mod'=>'blockfacebook'),$_smarty_tpl);?>
</h4>
	<div class="facebook-fanbox">
		<div class="fb-like-box" 
        	data-href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['facebookurl']->value, ENT_QUOTES, 'UTF-8', true);?>
" 
            data-height="240" 
            data-colorscheme="light" 
            data-show-faces="true" 
            data-header="false" 
            data-stream="false" 
            data-show-border="false">
		</div>
	</div>
</div>
<?php }?>
<?php }} ?>
