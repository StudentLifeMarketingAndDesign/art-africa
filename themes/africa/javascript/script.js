/*
 * Functions
 * =========
 */
function rems (n) {
  var htmlElement = document.getElementsByTagName('html')[0];
  return parseInt(getComputedStyle(htmlElement, null).getPropertyValue('font-size')) * n;
}

/*
 * toggle
 * ======
 */
$(document).on('click', '[data-toggle]', function () {
  var $el = $(this);
  var toggleSelector = $el.attr('data-toggle');
  var $toggleEls = $(toggleSelector);
  $toggleEls.toggleClass('toggle');
});

/*
 * #main_content img
 * =================
 */
function sizeMainContentImages () {
  // var $mc = $('#main_content');
  // $mc.find('img:not([width])').css('width', ($mc.outerWidth()+2).toString() + 'px')
  //                             .css('position', 'relative')
  //                             .css('left', '-' + $mc.css('padding-left'));
}
function setMainContentImgMaxWidth () {
  // $('#main_content img:not([width])').each(function () {
  //   $(this).on('load', function () {
  //     var nw = this.naturalWidth;
  //     $(this).css('max-width', nw.toString() + 'px')
  //   });
  // });
}
$(document).ready(setMainContentImgMaxWidth);
$(document).ready(sizeMainContentImages);
$(window).on('resize', sizeMainContentImages);

/*
 * #main_content min-height
 * ========================
 */
// $(document).ready(function () {
//   setMainContentMinHeight();
// });
// $(window).on('resize', function () {
//   setMainContentMinHeight();
// });
// function setMainContentMinHeight () {
//   if (window.outerWidth <= 768) {
//     $('#main_content').css('min-height', '0px');
//   } else {
//     $('#main_content').css('min-height', $('#middle .nav2').outerHeight().toString() + 'px');
//   }
// }

window.addEventListener('load', function() {
  setTimeout(function () {
    window.scrollTo(0, 1); // Hide the address bar on iOS
  }, 0);
});

$(document).ready(function () {
  // $('.gal').magnificPopup({
  //   delegate: '.gal-link',
  //   type: 'image',
  //   gallery: {
  //     enabled: true
  //   }
  // });
  $('#main_content').magnificPopup({
    delegate: '.artPhoto',
    type: 'image',
    gallery: {
      enabled: true,
      navigateByImgClick: false
    }
  });
});

$(document).on('click', '.mfp-img', function (event) {
  event.preventDefault();
  var src = $(this).attr('src'),
      ap  = $('.artPhoto[data-mfp-src="' + src + '"]:first');

  console.log(ap.length);
  document.location = ap.attr('data-mfp-href');
});


var map;
var country = new google.maps.LatLng(7.6219, 6.9743);

var MY_MAPTYPE_ID = 'custom_style';

function getCountry(results) {
  var geocoderAddressComponent,addressComponentTypes,address;
  for (var i in results) {
    geocoderAddressComponent = results[i].address_components;
    for (var j in geocoderAddressComponent) {
      address = geocoderAddressComponent[j];
      addressComponentTypes = geocoderAddressComponent[j].types;
      for (var k in addressComponentTypes) {
        if (addressComponentTypes[k] == 'country') {
          return address;
        }
      }
    }
  }
  return 'Unknown';
}

function initialize() {

  var featureOpts = [
  {
    "featureType": "water",
    "stylers": [
      { "visibility": "on" },
      { "color": "#0b0be6" },
      { "lightness": 88 },
      { "saturation": -45 }
    ]
  },{
    "featureType": "landscape.natural",
    "stylers": [
      { "color": "#828080" },
      { "lightness": 100 }
    ]
  },{
    "featureType": "administrative.country",
    "elementType": "geometry",
    "stylers": [
      { "color": "#e62033" },
      { "visibility": "on" },
      { "weight": 1.3 }
    ]
  },{
    "featureType": "road",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "visibility": "off" }
    ]
  }
];

  var geocoder;
  var marker;
  geocoder = new google.maps.Geocoder();

  var mapOptions = {
    zoom: 6,
    center: country,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
    },
    mapTypeId: MY_MAPTYPE_ID,
    draggableCursor: 'pointer'
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var styledMapOptions = {
    name: 'Custom Style'
  };

  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

  map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

  // var marker = new google.maps.Marker({
  //   position: country,
  //   map:      map,
  //   title:    'Example Country',
  //   url:      'https://www.google.com/'
  // });
  //http://gmaps-samples-v3.googlecode.com/svn/trunk/country_explorer/country_explorer.html
  google.maps.event.addListener(map, 'click', function(mouseEvent) {
    geocoder.geocode(
      {'latLng': mouseEvent.latLng},
      function(results, status) {
        // var headingP = document.getElementById('country');
        if (status == google.maps.GeocoderStatus.OK) {
          var country = getCountry(results);
          console.log(country);
          var matchingCountryLink = $('.nav2 a').filter(function () {
            var countryName = $(this).text();
            return countryName === country.long_name;
          });
          if (matchingCountryLink.length === 1) {
            document.location = matchingCountryLink.attr('href');
          } else {
            alert(country.long_name + ' not found in Africa.');
          }
          // marker.setPosition(mouseEvent.latLng);
          // marker.setIcon(getCountryIcon(country));
          // headingP.innerHTML = country.long_name+ ' <br> ';
        }
        // if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
        //   marker.setPosition(mouseEvent.latLng);
        //   marker.setIcon(
        //       getMsgIcon('Oups, I have no idea, are you on water?'));
        //   headingP.innerHTML = 'Oups, ' +
        //       'I have no idea, are you on water?';
        // }
        // if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
        //   marker.setPosition(mouseEvent.latLng);
        //   marker.setIcon(
        //       getMsgIcon('Whoa! Hold your horses :) You are quick! ' +
        //           'too quick!')
        //       );
        //   headingP.innerHTML = 'Whoa! You are just too quick!';
        // }
      }
    );
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
