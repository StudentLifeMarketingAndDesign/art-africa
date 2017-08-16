
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<% if $Source %>
			<p><a href="$Source.Link">Return to $Source.Title</a> <% if $CurrentMember %> | <a href="admin/assets/EditForm/field/File/item/{$Object.ID}/edit" target="_blank">Edit this Audio Piece</a><% end_if %> 
			
			 </p>
			<% end_if %>

			
							<div class="mediaItem">
								<iframe id="ytplayer" type="text/html" width="640" height="390"
				  src="https://www.youtube.com/embed/{$formattedIFrameURL}"
				  frameborder="0"></iframe>
								<span class="credit-line">$CreditLine</span>
							</div>

			

				
			<% include SocialShare %>

			<div class="clearfix"></div>
			
		</div>
	<% if $AltImage.Caption %>

		<div class="credit-line">$AltImage.Caption</div>

	<% else %>
		<div class="credit-line">$Caption</div>
	<% end_if %>
	</article>
		
</div>
<%-- include SideBar --%>