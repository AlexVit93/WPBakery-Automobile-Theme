console.log('DOM fully loaded');
console.log('Callback buttons found:', jQuery('.js-callback-open').length);
console.log('Calculator buttons found:', jQuery('.js-calc-open').length);
console.log('Popups found:', jQuery('.wm-popup').length);
jQuery(document).ready(function($) {
  $('.js-callback-open').on('click', function(e) {
    e.preventDefault();
    var formId = $(this).data('form-id');
    $('#callback-popup').addClass('active');
  }); 
  $('.wm-popup__close, .wm-popup__overlay').on('click', function() {
    $('#callback-popup').removeClass('active');
  });
  $(document).keyup(function(e) {
    if (e.key === "Escape") {
      $('#callback-popup').removeClass('active');
    }
  });
});