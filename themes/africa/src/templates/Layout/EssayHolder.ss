<div class="content-container typography">	
	<article>
		<div>
			<h1 class="hidden-tablet hidden-phone">$Title</h1>
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Topic Name</th>
		    		<th>Author</th>
		    		<th>Institution</th>
				</tr>
					<% loop getObjects('Essay') %>
						<tr>
							<% if Name %>
								<td><a href="{$Link(false)}">$Name </a></td>
							<% else_if Title %>
								<td><a href="{$Link(false)}">$Title </a></td>
							<% else %>
								<td>$ID</td>
							<% end_if %>
								<td>$AuthorFirstName $AuthorLastName</td>
								<td>$University</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
		
	</article>
	
</div>

<% include SideBar %>