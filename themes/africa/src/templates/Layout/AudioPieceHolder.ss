<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		<% loop getObjects('AudioPiece') %>
			<% if Title %>
				<li><a href="{$BaseHref}/media/audio/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		</div>
	</article>
		
</div>
<% include SideBar %>