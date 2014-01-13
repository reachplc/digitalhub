jQuery(function($){
	var bgImgs = new Array("/content/themes/digitalhub/images/back_one.jpg","/content/themes/digitalhub/images/back_two.jpg","/content/themes/digitalhub/images/back_three.jpg");
var selectedImage=Math.floor(Math.random()*(bgImgs.length));
$('#bgimg').css("background-image", "url("+bgImgs[selectedImage]+")");  

});