<% if Images %>
  <div class="image-scroller-container">
    <ul>
      <% loop RandomImages.Limit(30) %>
      <li>
      	<% if $AltImage %>
  				<img src="{$AltImage.CroppedFocusedImage(225,225).URL}" data-mfp-src="{$AltImage.SetRatioSize(1000,1000).URL}" class="artPhoto" title="Tap or Click for more info" data-mfp-href="$ShowLink">
  		<% else %>
  				<img src="{$CroppedFocusedImage(225,225).URL}" data-mfp-src="{$ScaledImage.URL}" class="artPhoto" title="Tap or Click for more info" data-mfp-href="$ShowLink">		
  		<% end_if %>
      </li>
      <% end_loop %>
      <li>
      	<a href="$ShowMoreLink" target="_blank"><div id="see-more" class="" title="Tap or Click to See All Images"><span>See All</span></div></a>
      </li>
    </ul>
    <p><a href="$ShowMoreLink" target="_blank">View all images in the media gallery &rarr;</a></p>
  </div>
<% end_if %> 