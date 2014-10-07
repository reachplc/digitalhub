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
    // Get item meta data
    $example_item = json_decode( get_post_meta($post->ID, '_example_item', true) );

    echo '<div class="example">'
        .'<div class="js-example-item" style="margin-bottom: 2em; padding-bottom: 1em; border-bottom: 1px solid #dedede"><fieldset><h4>Thumbnail</h4>'
        .'<div><p>Add a thumbnail image. This will be the first image displayed for the advert.</p></div>'
        .'<div class="js-preview-thumbnail">';

    if( !empty( $example_thumbnail ) ) {
      $attachment_id = (int) $example_thumbnail;
      $image_attributes = wp_get_attachment_image( $attachment_id, 'thumbnail', 1 ); // returns an array
      echo $image_attributes;
    }

    echo '</div>'
        .'<input id="js-data-thumbnail" class="js-data-thumbnail" name="_example_thumbnail" type="hidden">';

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

    // container for all examples
    echo '<div class="js-example-holder">';

    if( isset( $example_item ) ){

      foreach ( $example_item as $key=>$item ) {

        // Fill video template
        if( isset( $item->video ) ){
          echo '<div class="js-example-item" style="margin-bottom: 2em; padding-bottom: 1em; border-bottom: 1px solid #dedede"><fieldset><h4>Item</h4>';
          echo '<button class="js-example-remove">Remove Example</button>';
          echo '<input class="js-data-placeholder" name="_example_item['. $key .'][video][placeholder]" type="hidden" value="' . $item->video->placeholder . '">';
          echo '<input class="js-data-mp4" name="_example_item['. $key .'][video][mp4]" type="hidden" value="' . $item->video->mp4 . '">';
          echo '<input class="js-data-webm" name="_example_item['. $key .'][video][webm]" type="hidden" value="' . $item->video->webm . '">';
          echo '<div class="js-preview-thumbnail">';
          if( !empty( $item->video->placeholder ) ) {
            $attachment_id = (int) $item->video->placeholder;
            $image_attributes = wp_get_attachment_image( $attachment_id, 'thumbnail', 1 ); // returns an array
            echo $image_attributes;
          }
          echo '</div>';

          // Check for placeholder

          echo '<p>';
          echo '<button class="js-add-placeholder button-secondary"';
          if( !empty( $item->video->placeholder ) ){
            echo ' style="display: none;"';
          }
          echo '>Add Placeholder</button>';
          echo '<button class="js-remove-placeholder button-secondary"';
          if( empty( $item->video->placeholder ) ){
            echo ' style="display: none;"';
          }
          echo '>Remove Placeholder</button>';
          echo '<button class="js-add-mp4 button-secondary"';
          if( !empty( $item->video->mp4 ) ){
            echo ' style="display: none;"';
          }
          echo '>Add MP4</button>';
          echo '<button class="js-remove-mp4 button-secondary"';
          if( empty( $item->video->mp4 ) ){
            echo ' style="display: none;"';
          }
          echo '>Remove MP4</button>';
          echo '<button class="js-add-webm button-secondary"';
          if( !empty( $item->video->webm ) ){
            echo ' style="display: none;"';
          }
          echo '>Add WebM</button>';
          echo '<button class="js-remove-webm button-secondary"';
          if( empty( $item->video->webm ) ){
            echo ' style="display: none;"';
          }
          echo '>Remove WebM</button>';
          echo '</p>';
          echo '</fieldset></div>';
        }
        // Fill image template
        else if ( isset( $item->image ) ){
          echo '<div class="js-example-item" style="margin-bottom: 2em; padding-bottom: 1em; border-bottom: 1px solid #dedede"><fieldset><h4>Item</h4>';
          echo '<button class="js-example-remove">Remove Example</button>';
          echo '<input id="js-data-item" class="js-data-image" name="_example_item['. $key .'][image][placeholder]" type="hidden" value="' . $item->image->placeholder . '">';
          echo '<p><button id="js-add-image" class="button-secondary" style="display: none;">Add Image</button>';
          echo '<button id="js-remove-image" class="button-secondary">Remove Image</button>';
          echo '<div class="js-preview-thumbnail">';
          if( !empty( $item->image->placeholder ) ) {
            $attachment_id = (int) $item->image->placeholder;
            $image_attributes = wp_get_attachment_image( $attachment_id, 'thumbnail', 1 ); // returns an array
            echo $image_attributes;
          }
          echo '</div>';
          echo '</fieldset></div>';
        }

      }


      echo '</div>';

    }

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

    echo '</div>';
