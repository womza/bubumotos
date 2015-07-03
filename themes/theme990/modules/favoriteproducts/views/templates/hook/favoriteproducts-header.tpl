{strip}
	{addJsDef favorite_products_url_add=$link->getModuleLink('favoriteproducts', 'actions', ['process' => 'add'])|addslashes}
	{addJsDef favorite_products_url_remove=$link->getModuleLink('favoriteproducts', 'actions', ['process' => 'remove'], true)|addslashes}
	{if isset($smarty.get.id_product)}
		{addJsDef favorite_products_id_product=$smarty.get.id_product|intval}
	{/if} 
{/strip}