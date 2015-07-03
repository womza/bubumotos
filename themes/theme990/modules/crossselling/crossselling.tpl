{if isset($orderProducts) && count($orderProducts)}
    <section id="crossselling" class="page-product-box">
    	<h3 class="productscategory_h2 page-product-heading">
            {if $page_name == 'product'}
                {l s='Customers who bought this product also bought:' mod='crossselling'}
            {else}
                {l s='We recommend' mod='crossselling'}
            {/if}
        </h3>
    	<div id="crossselling_list">
            <ul id="crossselling_list_car" class="clearfix">
                {foreach from=$orderProducts item='orderProduct' name=orderProduct}
                    <li class="product-box item">
                        <a class="lnk_img product-image" href="{$orderProduct.link|escape:'html':'UTF-8'}" title="{$orderProduct.name|htmlspecialchars}" >
                            <img src="{$orderProduct.image}" alt="{$orderProduct.name|htmlspecialchars}" />
                        </a>
                        <p class="product_name">
                            <a href="{$orderProduct.link|escape:'html':'UTF-8'}" title="{$orderProduct.name|htmlspecialchars}">
                                {$orderProduct.name|truncate:15:'...'|escape:'html':'UTF-8'}
                            </a>
                        </p>
                        {if $crossDisplayPrice AND $orderProduct.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                            <p class="price_display">
                                <span class="price">{convertPrice price=$orderProduct.displayed_price}</span>
                            </p>
                        {/if}
                    </li>
                {/foreach}
            </ul>
        </div>
    </section>
{/if}
