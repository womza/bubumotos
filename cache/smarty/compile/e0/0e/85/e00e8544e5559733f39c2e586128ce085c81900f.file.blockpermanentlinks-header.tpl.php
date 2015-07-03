<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:48:25
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockpermanentlinks/blockpermanentlinks-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135210475556657c94915b8-23752500%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e00e8544e5559733f39c2e586128ce085c81900f' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockpermanentlinks/blockpermanentlinks-header.tpl',
      1 => 1432764723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135210475556657c94915b8-23752500',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556657c94abc71_29483740',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556657c94abc71_29483740')) {function content_556657c94abc71_29483740($_smarty_tpl) {?><!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li><a>Atención al cliente: 93 788 06 21</a></li>
	
    	
    
	<li id="header_link_sitemap">
    	<a <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='sitemap') {?>class="active"<?php }?> href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a>
    </li>
</ul>
<!-- /Block permanent links module HEADER -->
<?php }} ?>
