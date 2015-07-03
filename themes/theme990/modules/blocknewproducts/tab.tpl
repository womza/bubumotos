{counter name=active_li assign=active_li}
<li{if $active_li == 1} class="active"{/if}>
	<a data-toggle="tab" href="#blocknewproducts" class="blocknewproducts" title="{l s='New arrivals' mod='blocknewproducts'}">{l s='New arrivals' mod='blocknewproducts'}</a>
</li>