/**
 *  JQuery Random Hero - v0.1.0
 *  Supply's a random image to be loaded.
 *  http://michaelbragg.net
 *
 *  Made by Michael Bragg <michael@michaelbragg.net>
 *  Under MIT License
 */

;(function( $ ){

  var randomHero = randomHero || {};

  //  Default config settings

  randomHero.config = {
      parent: '.hero'
     ,path: 'path/to/image/'
     ,images : ['image01.jpg', 'image02.jpg', 'image03.jpg']
  };

  randomHero.init = function(config) {

    // provide for custom configuration via init()
    if (config && typeof(config) === 'object') {
      $.extend(randomHero.config, config);
    }

    var _images = randomHero.config.images,
        _randomNumber = Math.floor(Math.random()*(_images.length));

    $('#bgimg').css("background-image", "url("+randomHero.config.path+_images[_randomNumber]+")");

    // If you need to check the image being outputted.
    // Remove the comments from the line below:
    //console.log(_images[_randomNumber]);

  };

/**
 *  Code to be placed on web page to initialise the plugin.
 *
 *  To extend the default config settings
 *  pass a object as an argument for the init function
 *  eg. randomHero.init({ images: 'image01.jpg', 'image02.jpg' });
 */

  /*  Initialise and extend on page load */

  $(document).ready(function() {

    // To extend the default config settings
    // pass a object as an argument for the init function
    // eg. randomHero.init({ images: 'image01.jpg', 'image02.jpg' });

    randomHero.init( { parent: '#bgimg', path: 'content/themes/digitalhub/images/', images: ['back_one.png', 'backgroundtest_02.jpg', 'backgroundtest_03.jpg'] });

  });

})( jQuery );
