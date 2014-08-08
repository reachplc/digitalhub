(function ( $ ) {
  "use strict";

  jQuery(document).ready(function($){

    // Place your administration-specific JavaScript here

    var custom_uploader;

    $('#build-guide-upload').click(function(e) {

      e.preventDefault();

      //If the uploader object has already been created, reopen the dialog
      if (custom_uploader) {
        custom_uploader.open();
        return;
      }

      //Extend the wp.media object
      custom_uploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Build Guide',
        button: {
          text: 'Use as Build Guide'
        },
        multiple: false
      });

      //When a file is selected, grab the URL and set it as the text field's value
      custom_uploader.on('select', function() {

        var attachment = custom_uploader.state().get('selection').first().toJSON();

        function attach_url () {
          if( typeof attachment.sizes !== 'undefined' ) {
            return attachment.sizes.thumbnail.url;
          };
          return attachment.icon;
          };

          var preview = '<img src="' + attach_url() + '" alt="' + attachment.description + '">',
              hidden = '<input id="file-id" type="hidden" name="_build_guide" value="' + attachment.id + '">',
              remove = '<input id="build-guide-remove" name="build-guide-remove" class="button" type="button" value="Remove Build Guide">';

          // Add preview and hidden filed
          $('#new-setting').html( preview + hidden );
          // Add remove button
          $('#js-build-guide-controls').append( remove );

      });


      //Open the uploader dialog
      custom_uploader.open();

    });

    $('.inside').on('click', '#build-guide-remove', function(e) {

      console.log("clicked");

      e.preventDefault();

      // Remove value from hidden input field
      $('.inside #file-id').val('');
      // Remove thumbnail/icon
      $('#new-setting').find( 'img' ).remove();
      // Remove remove button
      $(this).remove();

    });

  });

}(jQuery));
