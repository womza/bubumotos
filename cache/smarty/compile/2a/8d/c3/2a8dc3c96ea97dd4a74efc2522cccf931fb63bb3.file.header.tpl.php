<?php /* Smarty version Smarty-3.1.19, created on 2015-06-16 11:22:44
         compiled from "/usr/home/bubumotos.com/web/ps/modules/seur/views/templates/hook/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136520539557feae417d2f7-99454046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a8dc3c96ea97dd4a74efc2522cccf931fb63bb3' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/modules/seur/views/templates/hook/header.tpl',
      1 => 1432053365,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136520539557feae417d2f7-99454046',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'customer_addresses_ids' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557feae4298999_03157631',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557feae4298999_03157631')) {function content_557feae4298999_03157631($_smarty_tpl) {?>
<script>
	var no_pickup_points_error_text = "<?php echo smartyTranslate(array('s'=>'Unable to find any PickUp points nearby','mod'=>'seur','js'=>1),$_smarty_tpl);?>
";
	
	var seur_token_ = [];
	
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ii'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['name'] = 'ii';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['customer_addresses_ids']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ii']['total']);
?>
		seur_token_[<?php echo $_smarty_tpl->tpl_vars['customer_addresses_ids']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ii']['index']];?>
] = "<?php echo Tools::getToken(mb_convert_encoding(htmlspecialchars((mb_convert_encoding(htmlspecialchars(@constant('SEUR_MODULE_NAME'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')).($_smarty_tpl->tpl_vars['customer_addresses_ids']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ii']['index']]), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'));?>
";
	<?php endfor; endif; ?>
	
</script><?php }} ?>
