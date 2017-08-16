<div class="content-container typography">
	$SearchFormPage
	<% if $Query %>
	<h1> Search Results</h1>
	<div class="visible-phone">
<% if $ResultsFound %><p>Jump to: <% if Subtopic %><a href="#subtopics">Subtopics ({$Subtopic.Count})</a> <% end_if %><% if People %><a href="#people">People ({$People.Count})</a> <% end_if %><% if Essay %><a href="#essays">Essays ({$Essay.Count})</a> <% end_if %><% if Country %><a href="#countries">Countries ({$Country.Count})</a> <% end_if %> </p><% end_if %><% if BibliographyPage %><a href="#bibliographic">Bibiographic Entries ({$BibliographyPage.Count})</a> <% end_if %>
	</div>
	<section class="search-results">
	
	<div id="searchResults">	
    	<% if $Chapter || $ChapterEssayPage %>
    		<h2 id="chapters">Chapters</h2>
    		<div class="search">
    			<table class="table table-hover">
    				<tbody>
    					<tr>
    						<th>Chapter Name</th>
    					
    						<th>Author</th>
    						<th>Institution</th>
    					</tr>
						<% loop $Chapter %>
							<tr>
								<td><a href="$Link">$Title</a></td>
								<td>$Author</td>
								<td>$University</td>
							</tr>
			    		<% end_loop %>					
			    		<% loop ChapterEssayPage %>
							<% if $Parent.ClassName == "Subtopic" %>
								<tr>
									<td><a href="{$Link}">{$Parent.Parent.Title}, {$Parent.Title}, Page $PageNo</a></td>
									<% with $Parent %>
										<td>$Author</td>
										<td>$University</td>
									<% end_with %>
								</tr>
							<% else %>
								<tr>
									<td><a href="{$Link}">{$Parent.Title}, Page $PageNo</a></td>
									<% with $Parent %>
										<td>$Author</td>
										<td>$University</td>
									<% end_with %>
								</tr>							
							<% end_if %>

					<% end_loop %>
    				</tbody>
    			</table>
    		</div>
    	<% end_if %>
        <% if Subtopic %>
            <h2 id="subtopics">Subtopics</h2>
			<div class="search">
			     <table class="table table-hover">
			        <tbody>
			            <tr>
			             	<th>Subtopic Name</th>
			            </tr>
			            <% loop Subtopic %>
			                    <tr>
			                        <% if Name %>
			                        	<td><a href="{$Link}">$Name</a></td>
			                        <% else_if Title %>
			                         	<td><a href="{$Link}">$Title</a></td>
			                        <% end_if %>
			                    </tr>                                        
			            <% end_loop %>
			        </tbody>
			    </table>
			</div>
		<% end_if %> 		  
		<% if People %>
			<h2 id="people">People</h2>
			<div class="search">
				<table class="table table-hover">
					<tbody>
					<tr>
						<th>People Name</th>
			    		<th>Countries</th>
			    		<th>Population</th>
					</tr>
						<% loop People %>
							<a href="{$Link}">
							<tr>
								<% if Name %>
									<td><a href="{$Link}">$Name</a></td>
								<% else_if Title %>
									<td><a href="{$Link}">$Title</a></td>
								<% end_if %>
								<% if Location %>
									<td>$Location</td>
									<% else %>
									<td>n/a</td>
								<% end_if %>
									<td><% if $Population %>$Population<% end_if %></td>
							</tr>
							</a>
											
						<% end_loop %>
					</tbody>
				</table>
		 	 </div>
		<% end_if %>
<%-- 	<% if ChapterEssayPage %>
		<h2 id="chapter-essays">Chapter Essays</h2>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
				<tr>
					
					<th>Essay Name</th>
		    		<th>Author</th>
		    		<th>Institution</th>
				</tr>

					<% loop ChapterEssayPage %>
						<% if $Parent %>
							<tr>
								<td><a href="{$Link}">{$Parent.Title}, Page $PageNo</a></td>
								<% with $Parent %>
									<td>$Author</td>
									<td>$University</td>
								<% end_with %>
							</tr>
						<% end_if %>
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %> --%>
	<% if $TopicEssayPage || $EssayContainer %>
		<h2 id="topic-essays">Topic Essays</h2>
		 <table class="table table-hover">
			<tbody>
			<tr>
				
				<th>Essay Name</th>
	    		<th>Author</th>
	    		<th>Institution</th>
			</tr>
				<% loop $EssayContainer %>
				<tr>
					<% if Name %>
						<td><a href="{$Link(false)}">$Name</a></td>
					<% else_if Title %>
						<td><a href="{$Link(false)}">$Title</a></td>
					<% end_if %>
						<td>$AuthorFirstName $AuthorLastName</td>
						<td>$University</td>
				</tr>					
			<% end_loop %> 
			<% loop $TopicEssayPage %>
				<% if $Parent %>
					<tr>
						<td><a href="{$Link}">{$Parent.Title}, Page $PageNo</a></td>
						<% with $Parent %>
							<td>$Author</td>
							<td>$University</td>
						<% end_with %>
					</tr>
				<% end_if %>
			<% end_loop %>
			</tbody>
		</table>
	<% end_if %>
	<% if Country %>
		<h2 id="countries">Countries</h2>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
				<tr>
					<th>Country Name</th>
		    		<th>Capital</th>
		    		<th>Population</th>
				</tr>
					<% loop Country %>
						<tr>
							<% if Name %>
								<td><a href="{$Link(false)}">$Name</a></td>
							<% else_if Title %>
								<td><a href="{$Link(false)}">$Title</a></td>
							<% end_if %>
								<td>$CapitalCity</td>
								<td>$Population</td>
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>
    <% end_if %>

    <% if BibliographyPage %>
    	<h2 id="bibliographic">Bibliographic Entries</h2>
    		<p>Entries for '$Query' can be found in the page(s) below:</p>
			<div class="search">
			 <table class="table table-hover">
				<tbody>
					<% loop BibliographyPage %>
						<tr>
							<td><a href="{$Link}">$Title</a></td>
			
						</tr>					
					<% end_loop %>
				</tbody>
			</table>
		  </div>

    <% end_if %>

      <% if VideoPiece %>
    	<h2 id="videos">Videos</h2>
    	<div class="media-container">
	    	<% loop VideoPiece %>
				<div class="item">
					<% include VideoPiece %>
				</div>			
			<% end_loop %>
    	</div>
    <% end_if %>
    <% if AudioPiece %>
    	<h2 id="audio">Audio</h2>
    	<div class="media-container">
	    	<% loop AudioPiece %>
				<div class="item">
					<% include AudioPiece %>
				</div>			
			<% end_loop %>
    	</div>
    <% end_if %>   
      <% if Image %>
    	<h2 id="images">Images</h2>
    	<div class="media-container">
    	<% loop Image.Limit(150) %>
	    	<div class="item">
	    	 <% include MediaGridImage %>
	    	</div>
    	<% end_loop %>
       	</div>

    <% end_if %>   
    <% if not $ResultsFound %>
		<p> Sorry, no results were found.</p>
		<% end_if %>

	<% else %>
		<p>Please enter a search term above.</p>
	<% end_if %>
	</div>		
	</section>
<% include SideBar %>