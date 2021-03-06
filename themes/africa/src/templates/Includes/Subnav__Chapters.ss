<% loop $ChildrenOf("chapters") %>
  <li>
    <% if $LinkOrSection == section %>
      <a href="$Link" class="nav3">$MenuTitle</a>
      <% if $Children %>
        <nav class="nav3">
          <ul>
            <% loop $Children %>
              <li>
                <a href="$Link"class="<% if $LinkOrCurrent == "current" %>selected<% end_if %>">
                  $MenuTitle
                </a>
              </li>
            <% end_loop %>	                   
          </ul>
        </nav><!-- end .nav3-->
      <% end_if %>
    <% else %>
     <a href="$Link">$MenuTitle</a>   
    <% end_if %>
  </li>
<% end_loop %>