{counter name=active_ul assign=active_ul}
{if isset($new_products) && $new_products}
	{include file="$tpl_dir./product-list.tpl" products=$new_products class='blocknewproducts tab-pane' id='blocknewproducts' active=$active_ul}
{else}
    <ul id="blocknewproducts" class="blocknewproducts tab-pane{if isset($active_ul) && $active_ul == 1} active{/if}">
        <li class="alert alert-info">{l s='No new products at this time.' mod='blocknewproducts'}</li>
    </ul>
{/if}