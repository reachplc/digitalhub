/**
 *  JQuery Example Switcher - v0.1.0
 *  Toggles classes depending upon supplied data.
 *  http://michaelbragg.net
 *
 *  Made by Michael Bragg <michael@michaelbragg.net>
 *  Under MIT License
 */

var exampleSwitch = exampleSwitch || {};

;(function( $ ){


  //  Default config settings

  exampleSwitch.config = {

  };

  exampleSwitch.init = function(config) {

    // provide for custom configuration via init()
    if (config && typeof(config) === 'object') {
      $.extend(exampleSwitch.config, config);
    }

//    $( '.example__video' ).each(function( index ) {
//      console.log( index, $( this ), $( this ).data('example') );
//    });

    var _holder = $( '.example__video' ).parent();

    var _clicked = $('.js-example-preview').on( 'click', function() {
      var _selected = $( this ).data('example');

     if( _selected === 1) {
        $('.example__video[data-example=1]').removeClass('hidden');
        $('.example__video[data-example=2]').addClass('hidden');
        $('.example__video[data-example=3]').addClass('hidden');

      }

      if( _selected === 2) {
        $('.example__video[data-example=1]').addClass('hidden');
        $('.example__video[data-example=2]').removeClass('hidden');
        $('.example__video[data-example=3]').addClass('hidden');
      }

      if( _selected === 3) {
        $('.example__video[data-example=1]').addClass('hidden');
        $('.example__video[data-example=2]').addClass('hidden');
        $('.example__video[data-example=3]').removeClass('hidden');
      }

    });

    //.attr('data-example');
    //var _video = $('.example__video').attr;
    //console.log();

  };

/**
 *  Code to be placed on web page to initialise the plugin.
 *
 *  To extend the default config settings
 *  pass a object as an argument for the init function
 *  eg. exampleSwitch.init({ images: 'image01.jpg', 'image02.jpg' });
 */

  /*  Initialise and extend on page load */

  $(document).ready(function() {

    // To extend the default config settings
    // pass a object as an argument for the init function
    // eg. exampleSwitch.init({ images: 'image01.jpg', 'image02.jpg' });

    exampleSwitch.init( );

  });

})( jQuery );
