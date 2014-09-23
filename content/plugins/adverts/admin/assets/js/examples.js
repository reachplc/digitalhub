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
function renderMediaUploader( $ ) {
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
    $( '#js-data-thumbnail' )
      .val( json.id );

    // Get url to use for preview



    // Build image
    var img = $('<img>', {
                  src: attach_url(json)
                 ,alt: json.caption
                 ,title: json.title
              })
              .appendTo( $( '#js-preview-thumbnail' ) );

    // Next, hide the anchor responsible for allowing the user to select an image
    $( '#js-add-thumbnail' )
        .hide();

    $( '#js-remove-thumbnail' )
        .show();

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



(function ( $ ) {
  "use strict";

  jQuery( document ).ready( function( $ ) {

    // Add event listener to call media uploader
    $( '#js-add-thumbnail' ).on( 'click', function( e ){
      // Stop the default behaviour
      e.preventDefault();
      // Display the media uploader
      renderMediaUploader( $ );
    });

    // Add event listener to remove thumbnail image
    $( '#js-remove-thumbnail' ).on( 'click', function( e ){
      // Stop the default behaviour
      e.preventDefault();
      // Remove image
      $( '#js-preview-thumbnail' )
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

  });

}(jQuery));
