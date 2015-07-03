<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:19:47
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockwishlist/blockwishlist-extra.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13503300655665113791492-27720825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9302b5eabf5bfb4f45506f0950e53b530606260' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blockwishlist/blockwishlist-extra.tpl',
      1 => 1428622220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13503300655665113791492-27720825',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5566511379ebb4_98311860',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5566511379ebb4_98311860')) {function content_5566511379ebb4_98311860($_smarty_tpl) {?><p class="buttons_bottom_block no-print">
	<a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['id_product']->value);?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
">
		<?php echo smartyTranslate(array('s'=>'Add to my wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</p>
<?php }} ?>
