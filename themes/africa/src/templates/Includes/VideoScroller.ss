<% if $VideoPieces %> 
 	<div class="media-container">
 		<h3>Video</h3>
 		<% loop $VideoPieces %>
 			<div class="item $ID">
 				<% include VideoPiece %>
 			</div>
 		<% end_loop %>	
 	</div>
<% end_if %>
