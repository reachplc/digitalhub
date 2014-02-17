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

    var _clicked = $('.js-example-preview').on( 'click', exampleSwitch.on);

  };

  exampleSwitch.on = function() {
    var _example = $( this ).children('img'),
        _holder = $( '.example__video' ).parent(),
        _children = _holder.children('.example__video'),
        _selected = _example.data('example'),
        _example_parent = _example.parents('.example__preview ul');

    exampleSwitch.preview(_example, _example_parent);

    for ( var i = 0; i < _children.length; i++ ) {

        var _current = i+1;

        if( _selected === _current ) {
          exampleSwitch.video(_current, 'play');
          $('.example__video[data-example=' + _current + ']').removeClass('hidden');
        }

        if( _selected !== _current ) {
          exampleSwitch.video(_current, 'pause');
          $('.example__video[data-example=' + _current + ']').addClass('hidden');
        }

    }

  };

  exampleSwitch.preview = function(example, parent) {

    var _parent = parent.children('li');

    $.each(_parent, function(){
      _this = $(this),  // Cache the DOM lookup
      _current = _this.children('img').data('example'),
      _clicked = example.data('example');

      //  Remove the icon on the selected element
      if ( _current === _clicked ) {
        _this.children('.icon').addClass('hidden');
        _this.addClass('example__preview--selected');
      }

      //  Add the icon on all non-selected elements
      if ( _current !== _clicked ) {
        _this.children('.icon').removeClass('hidden');
        _this.removeClass('example__preview--selected');
      }

    });

    exampleSwitch.video = function(video, action) {

      var _video = $('.example__video[data-example="' + video + '"] video').get(0),
          _action = action;

        //console.log(_video, _action);

        switch ( action ) {
          case 'play':
            if (_video.paused) {
              _video.play();
            }
            if(_video.play){

            }
            break;
          case 'pause':
            if (_video.play) {
              _video.pause();
            }
            if (_video.pause) {

            }
            break;
        }

    };

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
