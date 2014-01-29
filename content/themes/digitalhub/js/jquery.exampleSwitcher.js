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

    var _clicked = $('.js-example-preview').on( 'click', function() {

      var _holder = $( '.example__video' ).parent(),
          _children = _holder.children('.example__video'),
          _selected = $( this ).data('example');

          for ( var i = 0; i < _children.length; i++ ) {
              // Logs "try 0", "try 1", ..., "try 4".
              var _current = i+1;
              console.log( i, _current, _selected );

              if( _selected === _current ) {
                $('.example__video[data-example=' + _current + ']').removeClass('hidden');
              }
              if( _selected !== _current ) {
                $('.example__video[data-example=' + _current + ']').addClass('hidden');
              }
          }

    });

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
