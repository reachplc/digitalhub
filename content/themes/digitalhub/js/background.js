jQuery(function($){
	var bgImgs = new Array("/content/themes/digitalhub/images/back_one.png","/content/themes/digitalhub/images/backgroundtest_02.jpg","/content/themes/digitalhub/images/backgroundtest_03.jpg");
var selectedImage=Math.floor(Math.random()*(bgImgs.length));
$('#bgimg').css("background-image", "url("+bgImgs[selectedImage]+")");  

});