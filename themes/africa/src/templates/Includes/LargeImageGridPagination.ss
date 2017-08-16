<% if $getResults.MoreThanOnePage %>
		<% if $getResults.NextLink %><img src="{$ThemeDir}/dist/images/loader.gif" class="loader" /><% end_if %>
		<div class="item-list" id="pagination" style="display:none">
		<ul class="pager">	
		
	    <% if $getResults.PrevLink %>
	        <li class="pager-item"><a class="prev" href="$getResults.PrevLink">Previous</a></li>
	    <% end_if %>	
	
		<% loop $getResults.PaginationSummary(7) %>
			<% if CurrentBool %>
		         <span><li class="pager-current">$PageNum</li></span>
		    <% else %>
		     	<% if Link %>
		            <a href="$Link"><li class="pager-item">$PageNum</li></a>
		        <% else %>
		            <li class="pager-item">...</li>
		        <% end_if %>
		    <% end_if %>
		 <% end_loop %>  
		 <% if $getResults.NextLink %>
		 	<li class="pager-item"><a class="next" href="$getResults.NextLink">Next</a></li>
		 <% end_if %>
		 
		 </ul> 
		</div>
		 
	<% end_if %>  