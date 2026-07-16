function ClosePopup(){
  $('.open-sticky').removeClass('show-sticky');
  $('.rancak-popup').fadeOut('fast');
}



function open_sticky(){
  $('.open-sticky').click(function(){
    var get_id = $(this).attr('aria-popup-button');
	$('.open-sticky[aria-popup-button=' + get_id +']').toggleClass('show-sticky');
	$('.open-sticky').not('.open-sticky[aria-popup-button=' + get_id +']').removeClass('show-sticky');
    $('.rancak-popup[aria-popup-box=' + get_id +']').slideToggle('fast');
    $('.rancak-popup').not('[aria-popup-box=' + get_id +']').slideUp('fast');
	return false;
  });	
  
  $('.rancak-popup-overlay, .rancak-popup-close').click(function(){
    ClosePopup();
  });
}



var parallaxSection = document.querySelector(".section-cover .section-bg img");
function updateParallax() {
  if (parallaxSection) {
    var scrolled = window.pageYOffset;
    parallaxSection.style.top = (scrolled * 0.4) + "px";
  }
}
updateParallax();
window.addEventListener("scroll", updateParallax);



$(document).ready(function(){
  "use strict";
  open_sticky();
});