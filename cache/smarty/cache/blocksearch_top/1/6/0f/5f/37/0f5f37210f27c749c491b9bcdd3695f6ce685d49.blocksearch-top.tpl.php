<?php /*%%SmartyHeaderCode:282931601556651156de7b2-55935238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f5f37210f27c749c491b9bcdd3695f6ce685d49' => 
    array (
      0 => '/usr/home/bubumotos.com/web/ps/themes/theme990/modules/blocksearch/blocksearch-top.tpl',
      1 => 1428622220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '282931601556651156de7b2-55935238',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_558c866bee1b14_18251969',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_558c866bee1b14_18251969')) {function content_558c866bee1b14_18251969($_smarty_tpl) {?><!-- Block search module TOP -->
<div id="search_block_top" class="clearfix">
	<form id="searchbox" method="get" action="http://bubumotos.com/ps/buscar" >
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="Buscar" value="" />
		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span>Buscar</span>
		</button>
	</form>
</div>
<!-- /Block search module TOP --><?php }} ?>
