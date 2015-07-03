<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:24:18
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockwishlist/blockwishlist_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:91600360755665222975124-04650246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0568db39b21014c07c4d401280b33568213a767c' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockwishlist/blockwishlist_button.tpl',
      1 => 1428622220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91600360755665222975124-04650246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5566522298df09_77527321',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5566522298df09_77527321')) {function content_5566522298df09_77527321($_smarty_tpl) {?><div class="wishlist">
	<a class="addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="#" rel="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;" title="<?php echo smartyTranslate(array('s'=>'Add to Wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
">
		<?php echo smartyTranslate(array('s'=>'Add to Wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</div><?php }} ?>
