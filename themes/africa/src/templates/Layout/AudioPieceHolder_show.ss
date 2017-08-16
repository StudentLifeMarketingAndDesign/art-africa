
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<% if $Source %>
			<p><a href="$Source.Link">Return to $Source.Title</a> <% if $CurrentMember %> | <a href="admin/assets/EditForm/field/File/item/{$Object.ID}/edit" target="_blank">Edit this Audio Piece</a><% end_if %> 
			
			 </p>
			<% end_if %>

			<% with $Object %>
				<% include EmbeddedAudioPiece %>
			<% end_with %>

			<% include SocialShare %>

			<div class="clearfix"></div>
			
		</div>
		<% if $Object.Description %>
		<div class="content columns description">
			$Object.Description	
		</div>
		<% end_if %>
	</article>
		
</div>
<%-- include SideBar --%>