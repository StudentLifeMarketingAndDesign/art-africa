<% with $Object %>
<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content container-fluid">
			$Content
			<div class="row-fluid">
				<div class="span12 art-photo-grid" id="media">
				<% include SmallImageScroller %>
			</div>			
			<div class="row-fluid">
				<div class="span8">
					<% if TypesOfArt %>
						<h3>Types of Art</h3>
						<p>$TypesOfArt</p>
					<% end_if %>
					<% if History %>
						<h3>History</h3>
						<p>$History</p>
					<% end_if %>
					<% if Economy %>
						<h3>Economy</h3>
						<p>$Economy</p>
					<% end_if %>
					<% if PoliticalSystems %>
						<h3>Political Systems</h3>
						<p>$PoliticalSystems</p>
					<% end_if %>
					<% if Religion %>
						<h3>Religion</h3>
						<p>$Religion</p>	
					<% end_if %>		
				</div>
				<div class="span4 sticky"> <!--this isn't sticky-->
					<h2>Facts about $Title</h2>
					<% if Location %>
						<h3>Location</h3>
						<p>$Location</p>
							<% if $Picture %>
							<div style="width: 100%; ">
								<img style="width: 100%;" src="$Picture.URL" />
							</div>
						<% end_if %>
					<% end_if %>
					<h3>Countries</h3>
					<p>
					<% loop Countries %>
						<a href="$Link(false)">$Title</a><% if not $Last %>, <% end_if %>
					<% end_loop %>
				</p>
					<h3>Languages</h3>
					<p>$Languages</p>
					<h3>Population</h3>
					<p>$Population</p>
					<h3>Neighboring Peoples</h3>
						<p>$Neighbors</p>
					<% if $Tags %><h3>Tags</h3>
					<p>$Tags</p>
					<% end_if %>		
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12 art-photo-grid" id="media">
			    <% include AudioScroller %>
			    <% include VideoScroller %>
		</div>

	</article>
		
</div>
<% include SideBar %>
<% end_with %>