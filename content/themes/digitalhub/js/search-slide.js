jQuery(document).ready(function($) {
	
	$('button.search').on('click' , function() {
		$('button.search').toggleClass('clicked');
		$('.wrapper #search-slide').slideToggle();
	});
	$('#search-close').on('click' , function() {
		$('.wrapper #search-slide').slideToggle();
	});
});