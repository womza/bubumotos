<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 01:19:47
         compiled from "/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blocktopmenu/blocktopmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39433337055665113342cb1-72662124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65a7878d120fd4c8b660b1d1421bf28d4ca83db2' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blocktopmenu/blocktopmenu.tpl',
      1 => 1428622220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39433337055665113342cb1-72662124',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MENU' => 0,
    'MENU_SEARCH' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5566511337d901_41336599',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5566511337d901_41336599')) {function content_5566511337d901_41336599($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['MENU']->value!='') {?>
	<!-- Menu -->
	<div id="block_top_menu" class="sf-contener clearfix">
		<div class="cat-title"><?php echo smartyTranslate(array('s'=>"Categories",'mod'=>"blocktopmenu"),$_smarty_tpl);?>
</div>
        <ul class="sf-menu clearfix menu-content">
            <?php echo $_smarty_tpl->tpl_vars['MENU']->value;?>

            <?php if ($_smarty_tpl->tpl_vars['MENU_SEARCH']->value) {?>
                <li class="sf-search noBack" style="float:right">
                    <form id="searchbox" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8', true);?>
" method="get">
                        <p>
                            <input type="hidden" name="controller" value="search" />
                            <input type="hidden" value="position" name="orderby"/>
                            <input type="hidden" value="desc" name="orderway"/>
                            <input type="text" name="search_query" value="<?php if (isset($_GET['search_query'])) {?><?php echo htmlspecialchars($_GET['search_query'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" />
                        </p>
                    </form>
                </li>
            <?php }?>
        </ul>
	</div>
	<!--/ Menu -->
    
  <script type="text/javascript">
		$(document).ready(function() {
            $('.menu-content li:has(ul)').addClass('hasSub');
	   });
	   


$(document).ready(function(){
 var thisUrl = window.location.href;
 var thisPath = 'prices-drop';
  $('#block_top_menu ul li').each(function() {
		ourLink1 = $(this).children('a').attr('href');
		if (/prices-drop/i.test(ourLink1)) {
			$(this).addClass('sale-link');	
		}
  })
 if (/prices-drop/i.test(thisUrl)) {
  $('#block_top_menu ul li').each(function() {
  		ourLink = $(this).children('a').attr('href');
   		if (/prices-drop/i.test(ourLink)) {
    		$(this).addClass('sfHoverForce') 
   			}
      });
 	}

})
	</script>  
    
<?php }?>




<?php }} ?>
