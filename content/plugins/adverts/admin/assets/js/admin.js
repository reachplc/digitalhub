(function ( $ ) {
  "use strict";

  jQuery(document).ready(function($){

    // Place your administration-specific JavaScript here

  var custom_uploader;

  $('#advert-upload').click(function(e) {

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

      $('#new-setting').html('<img src="' + attach_url() + '" alt="' + attachment.description + '"><input id="file-id" name="adverts-settings[build_guide]" type="hidden" value="' + attachment.id + '">');

    });

    //Open the uploader dialog
    custom_uploader.open();

  });

  });

}(jQuery));
