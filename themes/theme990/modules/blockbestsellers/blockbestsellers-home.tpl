{counter name=active_ul assign=active_ul}
{if isset($best_sellers) && $best_sellers}
	{include file="$tpl_dir./product-list.tpl" products=$best_sellers class='blockbestsellers tab-pane' id='blockbestsellers' active=$active_ul}
{else}
	<ul id="blockbestsellers" class="blockbestsellers tab-pane{if isset($active_ul) && $active_ul == 1} active{/if}">
		<li class="alert alert-info">{l s='No best sellers at this time.' mod='blockbestsellers'}</li>
	</ul>
{/if}