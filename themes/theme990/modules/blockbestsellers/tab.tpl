{counter name=active_li assign=active_li}
<li{if $active_li == 1} class="active"{/if}>
	<a data-toggle="tab" href="#blockbestsellers" class="blockbestsellers" title="{l s='Best Sellers' mod='blockbestsellers'}">{l s='Best Sellers' mod='blockbestsellers'}</a>
</li>