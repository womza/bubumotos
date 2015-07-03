{counter name=active_ul assign=active_ul}
{if isset($products) && $products}
	{include file="$tpl_dir./product-list.tpl" class='homefeatured tab-pane' id='homefeatured' active=$active_ul}
{else}
    <ul id="homefeatured" class="homefeatured tab-pane{if isset($active_ul) && $active_ul == 1} active{/if}">
        <li class="alert alert-info">{l s='No featured products at this time.' mod='homefeatured'}</li>
    </ul>
{/if}