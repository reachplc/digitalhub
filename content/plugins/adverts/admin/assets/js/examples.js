/**
 * Examples.js
 */

/**
 * Callback function for the 'click' event of the 'Set Footer Image'
 * anchor in its meta box.
 *
 * Displays the media uploader for selecting an image.
 *
 * @since 0.1.0
 */
function renderMediaUploader( $, output ) {
'use strict';

var file_frame, image_data;

/**
 * If an instance of file_frame already exists, then we can open it
 * rather than creating a new instance.
 */
if ( undefined !== file_frame ) {

    file_frame.open();
    return;

}

  /**
   * If we're this far, then an instance does not exist, so we need to
   * create our own.
   *
   * Here, use the wp.media library to define the settings of the Media
   * Uploader. We're opting to use the 'post' frame which is a template
   * defined in WordPress core and are initializing the file frame
   * with the 'insert' state.
   *
   * We're also not allowing the user to select more than one image.
   */
  file_frame = wp.media.frames.file_frame = wp.media({
      frame:    'post',
      state:    'insert',
      multiple: false
  });

  /**
   * Setup an event handler for what to do when an image has been
   * selected.
   *
   * Since we're using the 'view' state when initializing
   * the file_frame, we need to make sure that the handler is attached
   * to the insert event.
   */
  file_frame.on( 'insert', function() {

    // Read the JSON data returned from the Media Uploader
    var json = file_frame.state().get( 'selection' ).first().toJSON();
    // First, make sure that we have the URL of an image to display
    if ( 0 > $.trim( json.url.length ) ) {
        return;
    }



    //  Update hidden input with media id to save in database
    $( output )
      .val( json.id );

    // Get url to use for preview



    // Build image
    var img = $('<img>', {
                  src: attach_url(json)
                 ,alt: json.caption
                 ,title: json.title
              })
              .appendTo( $( output ).closest('.js-example-item').find( '.js-preview-thumbnail' ) );

    if ( $(output).is( '.js-data-thumbnail' ) ) {
    // Next, hide the anchor responsible for allowing the user to select an image
    $( '#js-add-thumbnail' )
        .hide();

    $( '#js-remove-thumbnail' )
        .show();
    }

    if ( $(output).is( '#js-data-item' ) ) {

        var $_container = output.closest('.js-example-item');

        $_container.find('#js-remove-image').show();
        $_container.find('#js-add-image').hide();

        console.log( 'output', $_container );

    }

    //console.log('output', output);

  });

  // Now display the actual file_frame
  file_frame.open();

}



function attach_url ( data ) {
  if( typeof data.sizes !== 'undefined' ) {
    if( typeof data.sizes.thumbnail !== 'undefined' ) {
      return data.sizes.thumbnail.url;
    }
    return data.sizes.full.url;
  };
  return data.icon;
};

/**
 * Templates for adding items
 */

// Image

function addImage ( $ ) {
  var imageTemplate = '<div class="js-example-item" style="margin-bottom: 2em; padding-bottom: 1em; border-bottom: 1px solid #dedede"><fieldset><h4>Item</h4>'
                    + '<button class="js-example-remove">Remove Example</button>'
                    + '<input id="js-data-item" class="js-data-image" name="_example_item[][image][placeholder]" type="text" value="">'
                    + '<p><button id="js-add-image" class="button-secondary">Add Image</button>'
                    + '<button id="js-remove-image" class="button-secondary" style="display: none;">Remove Image</button>'
                    + '<div class="js-preview-thumbnail"></div>'
                    + '</fieldset></div>';
  $( '#js-example-holder' ).append( imageTemplate );
}

// Video

function addVideo ( $ ) {
  var imageTemplate = '<div class="js-example-item" style="margin-bottom: 2em; padding-bottom: 1em; border-bottom: 1px solid #dedede"><fieldset><h4>Item</h4>'
                    + '<button class="js-example-remove">Remove Example</button>'
                    + '<input id="js-data-item" name="_example_item[][placeholder]" type="text">'
                    + '<input id="js-data-item" name="_example_item[][mp4]" type="text">'
                    + '<input id="js-data-item" name="_example_item[][webm]" type="text">'
                    + '<div class="js-preview-thumbnail"></div>'
                    + '<p><button id="js-add-placeholder" class="button-secondary">Add Placeholder</button>'
                    + '<button id="js-remove-placeholder" class="button-secondary" style="display: none;">Remove Placeholder</button>'
                    + '<button id="js-add-mp4" class="button-secondary">Add MP4</button>'
                    + '<button id="js-add-webm" class="button-secondary">Add WebM</button>'
                    + '</p>'
                    + '</fieldset></div>';
  $( '#js-example-holder' ).append( imageTemplate );
}

/* Logic */

(function ( $ ) {
  "use strict";

  jQuery( document ).ready( function( $ ) {

    // Add event listener to call media uploader
    $( '#js-add-thumbnail' ).on( 'click', function( e ){
      // Stop the default behaviour
      e.preventDefault();
      // Display the media uploader
      renderMediaUploader( $, '.js-data-thumbnail' );
    });

    $( '#js-example-holder' ).on( 'click', '#js-add-image', function( e ){
      // Stop the default behaviour
      e.preventDefault();
      var field = $(this).closest('.js-example-item')
          .find( '#js-data-item' );
      // Display the media uploader
      renderMediaUploader( $, field );
    });

    // Add event listener to remove thumbnail image
    $( '#js-remove-thumbnail' ).on( 'click', function( e ){
      // Stop the default behaviour
      e.preventDefault();
      // Remove image
      $( '.js-preview-thumbnail' )
        .children( 'img' )
            .remove();
      // Remove id from hidden field
      $( '#js-data-thumbnail' )
      .val( '' );

      // Show Add button
      $( '#js-add-thumbnail' )
        .show();
      // Hide remove button
      $( '#js-remove-thumbnail' )
        .hide();

    });

    // Add event listener to remove example
    $( '#js-example-holder' ).on( 'click', '.js-example-remove', function( e ) {

      e.preventDefault();

      var $_container = $(this).closest('.js-example-item');
      $_container.remove();

    });

    // Add event listener to remove image
    $( '#js-example-holder' ).on( 'click', '#js-remove-image', function( e ){
      // Stop the default behaviour
      e.preventDefault();

      var $_container = $(this).closest('.js-example-item');

      $_container.find('.js-data-image').val( '' );
      $_container.find( 'img' ).remove();
      $_container.find('#js-remove-image').hide();
      $_container.find('#js-add-image').show();

    });


    /**
     * New Items
     */

    $( '#js-new-image' ).on( 'click', function( e ) {
      e.preventDefault( );
      addImage( $ );
    });

    $( '#js-new-video' ).on( 'click', function( e ) {
      e.preventDefault( );
      addVideo( $ );
    });

  });

}(jQuery));
