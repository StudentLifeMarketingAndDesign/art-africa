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
  var $mc = $('#main_content');
  $mc.find('img:not([width])').css('width', ($mc.outerWidth()+2).toString() + 'px')
                              .css('position', 'relative')
                              .css('left', '-' + $mc.css('padding-left'));
}
function setMainContentImgMaxWidth () {
  $('#main_content img:not([width])').each(function () {
    $(this).on('load', function () {
      var nw = this.naturalWidth;
      $(this).css('max-width', nw.toString() + 'px')
    });
  });
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
  // could visit ap.attr('href')
});
