<?php

    global $post;

    $example_limit = 3;
    /* Formats allowed */
    $_formats      = array( 'mp4', 'webm' );
    $custom        = get_post_custom($post->ID);

    wp_nonce_field( 'example_inner_build_guide_box', 'example_inner_build_guide_box_nonce' );

    /**
     * Add examples to this post
     */

    // Get thumbnail meta data
    $example_thumbnail = get_post_meta($post->ID, '_example_thumbnail', true);

    echo '<div style="margin-bottom: 2em; padding-bottom: 1em; border-bottom: 1px solid #dedede"><fieldset><h4>Thumbnail</h4>'
        .'<div><p>Add a thumbnail image. This will be the first image displayed for the advert.</p></div>'
        .'<div id="js-preview-thumbnail">';

    if( !empty( $example_thumbnail ) ) {
      $attachment_id = (int) $example_thumbnail;
      $image_attributes = wp_get_attachment_image( $attachment_id, 'thumbnail', 1 ); // returns an array
      echo $image_attributes;
    }

    echo '</div>'
        .'<input id="js-data-thumbnail" name="_example_thumbnail" type="hidden">';

    if( !empty( $example_thumbnail ) ) {

      echo '<p><button id="js-add-thumbnail" class="button-secondary" style="display: none;">Add Thumbnail</button>'
          .'<button id="js-remove-thumbnail" class="button-secondary">Remove Thumbnail</button></p>';
    } else {
      echo '<p><button id="js-add-thumbnail" class="button-secondary">Add Thumbnail</button>'
          .'<button id="js-remove-thumbnail" class="button-secondary" style="display: none;">Remove Thumbnail</button></p>';
    }

    echo '</fieldset></div>';

    echo '<button id="js-new-image">New Image</button>';
    echo '<button id="js-new-video">New Video</button>';

    echo '<div><h4>Image</h4><button>Add Image</button></div>';

    echo '<div><h4>Video</h4>';

    echo '</div>';


    for ($i = 1; $i <= $example_limit; $i++) {

      $example_preview = get_post_meta($post->ID, '_example_' . $i .'_url_preview', true);
      $example_video = get_post_meta($post->ID, '_example_' . $i .'_url_video', true);

      echo '<fieldset>';
      echo '<legend>Example ' . $i .' URL:</legend>';

      echo '<p>';
      echo '<label for="_example_' . $i .'_url_preview">Preview: </label><br>';
      echo '<input type="text" name="_example_' . $i .'_url_preview" placeholder="http://example.net/preview-image.png" value="' . urldecode($example_preview) . '" disabled>';
      echo '</p>';
      // To be depreciated in 0.3.0
      echo '<p>';
      echo '<label for="_example_' . $i .'_url_video">Video Placeholder: </label><br>';
      echo '<input type="text" name="_example_' . $i .'_url_video" placeholder="http://example.net/video-image.png" value="' . urldecode($example_video) . '" disabled>';
      echo '</p>';

      foreach ($_formats as $value) {
        // Get current value
        $example_value    = get_post_meta($post->ID, '_example_'. $i . '_url_' . $value, true);
        echo '<p>';
        echo '<label for="_example_' . $i .'_url_' . $value . '">'. $value .'</label><br>';
        echo '<input type="text" name="_example_' . $i .'_url_' . $value . '" id="example_' . $i .'_url_' . $value . '" placeholder="http://example.net/video.' . $value . '" value="' . urldecode($example_value) . '" disabled>';
        echo '</p>';
      }

      unset($value);

      echo '</fieldset>';
    }
