<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:19:49
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1104306945566511578d001-32656760%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0502cf595978570e4c0fdc5731915449f1cb7062' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/footer.tpl',
      1 => 1428622222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1104306945566511578d001-32656760',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'HOOK_HOME' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_556651157bdf49_53756180',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556651157bdf49_53756180')) {function content_556651157bdf49_53756180($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
					</div><!-- .row -->
                 
                 
                 <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) {?>
                    <div class="clearfix block-cms-fb"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>
</div>
                <?php }?>             
                    
                    
				</div><!-- #columns -->
                                
			</div><!-- .columns-container -->
			<!-- Footer -->
               
			<div class="footer-container">
				<footer id="footer"  class="container">
					<div class="row"><?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
</div>
				</footer>
			</div><!-- #footer -->            
      </div>      
            
		</div><!-- #page -->
<?php }?>



<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</body>
</html><?php }} ?>
