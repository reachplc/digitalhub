var bgImgs = new Array("/wp-content/themes/digitalhub/images/back_one.jpg","/wp-content/themes/digitalhub/images/back_two.jpg","/wp-content/themes/digitalhub/images/back_three.jpg");
var selectedImage=Math.floor(Math.random()*(bgImgs.length));
$('#bg-img').css("background-image", "url("+bgImgs[selectedImage]+")");  
