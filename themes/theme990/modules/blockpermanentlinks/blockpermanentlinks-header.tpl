<!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li><a>Atención al cliente: 93 788 06 21</a></li>
	{*<li id="header_link_contact">*}
    	{*<a {if $page_name =='contact'}class="active"{/if} href="{$link->getPageLink('contact', true)|escape:'html'}" title="{l s='contact' mod='blockpermanentlinks'}">{l s='contact' mod='blockpermanentlinks'}</a>*}
    {*</li>*}
	<li id="header_link_sitemap">
    	<a {if $page_name =='sitemap'}class="active"{/if} href="{$link->getPageLink('sitemap')|escape:'html'}" title="{l s='sitemap' mod='blockpermanentlinks'}">{l s='sitemap' mod='blockpermanentlinks'}</a>
    </li>
</ul>
<!-- /Block permanent links module HEADER -->
