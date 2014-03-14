/* Skip Link Focus */
( function() {
  var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
      is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
      is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

  if ( ( is_webkit || is_opera || is_ie ) && 'undefined' !== typeof( document.getElementById ) ) {
    var eventMethod = ( window.addEventListener ) ? 'addEventListener' : 'attachEvent';
    window[ eventMethod ]( 'hashchange', function() {
      var element = document.getElementById( location.hash.substring( 1 ) );

      if ( element ) {
        if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
          element.tabIndex = -1;

        element.focus();
      }
    }, false );
  }
})();

/**
 *  JQuery Random Hero - v0.1.0
 *  Supply's a random image to be loaded.
 *  http://michaelbragg.net
 *
 *  Made by Michael Bragg <michael@michaelbragg.net>
 *  Under MIT License
 */

var randomHero = randomHero || {};

;(function( $ ){


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

    $(randomHero.config.parent).css("background-image", "url("+randomHero.config.path+_images[_randomNumber]+")");

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

  /*  Initialise and extend on page load

  $(document).ready(function() {

    // To extend the default config settings
    // pass a object as an argument for the init function
    // eg. randomHero.init({ images: 'image01.jpg', 'image02.jpg' });

    randomHero.init( { parent: '#bgimg', path: 'content/themes/digitalhub/images/', images: ['back_one.png', 'backgroundtest_02.jpg', 'backgroundtest_03.jpg'] });

  }); */

})( jQuery );


/* Search Slid */

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