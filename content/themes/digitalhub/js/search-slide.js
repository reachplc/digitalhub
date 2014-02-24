jQuery(document).ready(function($) {  
	
	$('button.search').on('click' , function() {
		$('button.search').toggleClass('clicked');
		$('.wrapper #search-slide').slideToggle();
	});
	
    $('#search-close').on('click' , function() {
		$('.wrapper #search-slide').slideToggle();
	});
});


;(function( $ ){
  $( window ).resize(function() {
    var wi = $(window).width();
      if (wi >= 768){
            $('.wrapper #search-slide').hide();
            $('button.search').removeClass('clicked');
            }
  });
})( jQuery );