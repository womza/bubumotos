<ul class="color_to_pick_list clearfix">
	{foreach from=$colors_list item='color'}
		<li>
			<a href="{$link->getProductLink($color.id_product, null, null, null, null, null, $color.id_product_attribute)|escape:'html':'UTF-8'}" id="color_{$color.id_product_attribute|intval}" class="color_pick" style="background: {$color.color};"></a>
		</li>
	{/foreach}
</ul>