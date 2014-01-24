jQuery(document).ready(function($) {
	
	$('.search').on('click' , function() {
		$('.search').toggleClass('clicked');
		$('.wrapper #search-slide').slideToggle();
	});
	$('#search-close').on('click' , function() {
		$('.wrapper #search-slide').slideToggle();
	});
});