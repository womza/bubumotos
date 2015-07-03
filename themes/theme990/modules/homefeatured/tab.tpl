{counter name=active_li assign=active_li}
<li{if $active_li == 1} class="active"{/if}>
	<a data-toggle="tab" href="#homefeatured" class="homefeatured" title="{l s='Popular' mod='homefeatured'}">{l s='Popular' mod='homefeatured'}</a>
</li>