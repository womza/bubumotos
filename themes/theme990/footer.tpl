{if !$content_only}
					</div><!-- #center_column -->
					{if isset($right_column_size) && !empty($right_column_size)}
						<div id="right_column" class="col-xs-12 col-sm-{$right_column_size|intval} column">{$HOOK_RIGHT_COLUMN}</div>
					{/if}
					</div><!-- .row -->
                 
                 
                 {if isset($HOOK_HOME) && $HOOK_HOME|trim}
                    <div class="clearfix block-cms-fb">{$HOOK_HOME}</div>
                {/if}             
                    
                    
				</div><!-- #columns -->
                                
			</div><!-- .columns-container -->
			<!-- Footer -->
               
			<div class="footer-container">
				<footer id="footer"  class="container">
					<div class="row">{$HOOK_FOOTER}</div>
				</footer>
			</div><!-- #footer -->            
      </div>      
            
		</div><!-- #page -->
{/if}



{include file="$tpl_dir./global.tpl"}
	</body>
</html>