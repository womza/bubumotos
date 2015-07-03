{if $MENU != ''}
	<!-- Menu -->
	<div id="block_top_menu" class="sf-contener clearfix">
		<div class="cat-title">{l s="Categories" mod="blocktopmenu"}</div>
        <ul class="sf-menu clearfix menu-content">
            {$MENU}
            {if $MENU_SEARCH}
                <li class="sf-search noBack" style="float:right">
                    <form id="searchbox" action="{$link->getPageLink('search')|escape:'html':'UTF-8'}" method="get">
                        <p>
                            <input type="hidden" name="controller" value="search" />
                            <input type="hidden" value="position" name="orderby"/>
                            <input type="hidden" value="desc" name="orderway"/>
                            <input type="text" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|escape:'html':'UTF-8'}{/if}" />
                        </p>
                    </form>
                </li>
            {/if}
        </ul>
	</div>
	<!--/ Menu -->
    
  <script type="text/javascript">
		$(document).ready(function() {
            $('.menu-content li:has(ul)').addClass('hasSub');
	   });
	   


$(document).ready(function(){
 var thisUrl = window.location.href;
 var thisPath = 'prices-drop';
  $('#block_top_menu ul li').each(function() {
		ourLink1 = $(this).children('a').attr('href');
		if (/prices-drop/i.test(ourLink1)) {
			$(this).addClass('sale-link');	
		}
  })
 if (/prices-drop/i.test(thisUrl)) {
  $('#block_top_menu ul li').each(function() {
  		ourLink = $(this).children('a').attr('href');
   		if (/prices-drop/i.test(ourLink)) {
    		$(this).addClass('sfHoverForce') 
   			}
      });
 	}

})
	</script>  
    
{/if}




