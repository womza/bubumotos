<?php /* Smarty version Smarty-3.1.19, created on 2015-06-16 11:22:45
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/order-steps.tpl" */ ?>
<?php /*%%SmartyHeaderCode:916789186557feae5006226-62459699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab372f9ef84c699260cecd7c5562c92f16980e14' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/order-steps.tpl',
      1 => 1428622220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '916789186557feae5006226-62459699',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'back' => 0,
    'multi_shipping' => 0,
    'opc' => 0,
    'current_step' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557feae5186d10_03725479',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557feae5186d10_03725479')) {function content_557feae5186d10_03725479($_smarty_tpl) {?>
<?php $_smarty_tpl->_capture_stack[0][] = array("url_back", null, null); ob_start(); ?>
	<?php if (isset($_smarty_tpl->tpl_vars['back']->value)&&$_smarty_tpl->tpl_vars['back']->value) {?>back=<?php echo $_smarty_tpl->tpl_vars['back']->value;?>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if (!isset($_smarty_tpl->tpl_vars['multi_shipping']->value)) {?>
	<?php $_smarty_tpl->tpl_vars['multi_shipping'] = new Smarty_variable('0', null, 0);?>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
    <!-- Steps -->
    <ul class="step clearfix" id="order_step">
        <li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='summary') {?>step_current <?php } elseif ($_smarty_tpl->tpl_vars['current_step']->value=='login') {?>step_done_last step_done<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address'||$_smarty_tpl->tpl_vars['current_step']->value=='login') {?>step_done<?php } else { ?>step_todo<?php }?><?php }?> first">
            <?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address'||$_smarty_tpl->tpl_vars['current_step']->value=='login') {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true);?>
" title="<?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>
">
                    <em>01.</em> <?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>

                </a>
            <?php } else { ?>
                <span><em>01.</em> <?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>
</span>
            <?php }?>
        </li>
        <li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='login') {?>step_current<?php } elseif ($_smarty_tpl->tpl_vars['current_step']->value=='address') {?>step_done step_done_last<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address') {?>step_done<?php } else { ?>step_todo<?php }?><?php }?> second">
            <?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping'||$_smarty_tpl->tpl_vars['current_step']->value=='address') {?>
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,((string)Smarty::$_smarty_vars['capture']['url_back'])."&step=1&multi-shipping=".((string)$_smarty_tpl->tpl_vars['multi_shipping']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Sign in'),$_smarty_tpl);?>
">
                    <em>02.</em> <?php echo smartyTranslate(array('s'=>'Sign in'),$_smarty_tpl);?>

                </a>
            <?php } else { ?>
                <span><em>02.</em> <?php echo smartyTranslate(array('s'=>'Sign in'),$_smarty_tpl);?>
</span>
            <?php }?>
        </li>
        <li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='address') {?>step_current<?php } elseif ($_smarty_tpl->tpl_vars['current_step']->value=='shipping') {?>step_done step_done_last<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping') {?>step_done<?php } else { ?>step_todo<?php }?><?php }?> third">
            <?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment'||$_smarty_tpl->tpl_vars['current_step']->value=='shipping') {?>
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,((string)Smarty::$_smarty_vars['capture']['url_back'])."&step=1&multi-shipping=".((string)$_smarty_tpl->tpl_vars['multi_shipping']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
">
                    <em>03.</em> <?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>

                </a>
            <?php } else { ?>
                <span><em>03.</em> <?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</span>
            <?php }?>
        </li>
        <li class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='shipping') {?>step_current<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment') {?>step_done step_done_last<?php } else { ?>step_todo<?php }?><?php }?> four">
            <?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment') {?>
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,((string)Smarty::$_smarty_vars['capture']['url_back'])."&step=2&multi-shipping=".((string)$_smarty_tpl->tpl_vars['multi_shipping']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>
">
                    <em>04.</em> <?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>

                </a>
            <?php } else { ?>
                <span><em>04.</em> <?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>
</span>
            <?php }?>
        </li>
        <li id="step_end" class="<?php if ($_smarty_tpl->tpl_vars['current_step']->value=='payment') {?>step_current<?php } else { ?>step_todo<?php }?> last">
            <span><em>05.</em> <?php echo smartyTranslate(array('s'=>'Payment'),$_smarty_tpl);?>
</span>
        </li>
    </ul>
    <!-- /Steps -->
<?php }?>
<?php }} ?>
