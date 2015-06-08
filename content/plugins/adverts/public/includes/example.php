<?php

/**
 *  Function to check to see if there are examples
 *
 *  returns boolean
 */

function is_example() {

  global $post;
  // Get item meta data
  $example_item = json_decode( get_post_meta($post->ID, '_example_item', TRUE ) );
  $old_example_items = get_post_meta( $post->ID, '_example_1_url_video', TRUE );

  // Test for examples
  if ( isset( $example_item ) ) {
    return true;
  }

  // Test for old examples
  if ( isset( $old_example_items ) ) {
    return true;
  }

  // No build guide found
  return false;

}

/**
 * Get all preview images
 *
 * @since    0.1.0
 *
 * @param $custom The array returned by get_post_custom.
 */
/**
 * Get all preview images
 */

function get_example_preview() {

  global $post;
  $_example_limit = 2;
  $custom = get_post_custom( $post->ID );
  // Get item meta data
  $example_item = json_decode( get_post_meta($post->ID, '_example_item', TRUE ) );
  $old_example_items = get_post_meta( $post->ID, '_example_1_url_video', TRUE );

  if ( isset( $example_item ) ) {

    // Loop all examples
    foreach ( $example_item as $key=>$item ) {


      if( !empty( $item->image->placeholder ) ) {
        echo '<li class="js-example-preview';
        if ($key == 0){echo ' example__preview--selected';}
        echo '"><span class="sprite sprite--play icon icon__overlay';
        if ($key == 0){echo ' hidden';}
        echo '"></span>';
        echo '<img class="example__preview--image" data-example="' . $key . '" src="' . wp_get_attachment_url( $item->image->placeholder ) . '">';
        echo '</li>';
      }

      if( !empty( $item->video->placeholder ) ) {
        echo '<li class="js-example-preview';
        if ($key == 0){echo ' example__preview--selected';}
        echo '"><span class="sprite sprite--play icon icon__overlay';
        if ($key == 0){echo ' hidden';}
        echo '"></span>';
        echo '<img class="example__preview--image" data-example="' . $key . '" src="' . wp_get_attachment_url( $item->video->placeholder ) . '">';
        echo '</li>';
      }

    }
  }

  if ( isset( $old_example_items ) ) {
    // Build each old example
    for ( $i = 0; $i <= $_example_limit; $i++ ) {

      $_temp = ($i + 1);

      if( !empty( $custom['_example_' . $_temp . '_url_preview'] ) ) {

      $_example_preview = urldecode( $custom['_example_' . $_temp . '_url_preview'][0] );

      echo '<li class="js-example-preview';
      if ($i == 0){echo ' example__preview--selected';}
      echo '"><span class="sprite sprite--play icon icon__overlay';
      if ($i == 0){echo ' hidden';}
      echo '"></span><img class="example__preview--image" data-example="' . $i . '" src="' .$_example_preview . '"></li>';
      }
    }
  }

}

/**
 *
 */

function get_example_video() {

  global $post;
  $custom = get_post_custom( $post->ID );
  $example_thumbnail = json_decode( get_post_meta($post->ID, '_example_thumbnail', TRUE ) );
  $example_item = json_decode( get_post_meta($post->ID, '_example_item', TRUE ) );


  if ( isset( $example_item ) ) {

    //print_r( $example_item );

    foreach ( $example_item as $key=>$item ) {

      if( !empty( $item->image->placeholder ) ) {
        echo '<div class="example__video';
        if($key != 0){
          echo' hidden';
        };
        echo '" data-example="' . $key . '">';
        echo '<img class="image__responsive" src="' . wp_get_attachment_url( $item->image->thumbnail ) . '">';
        echo '</div>';
      }

      if( !empty( $item->video->placeholder ) ) {
        echo '<div class="example__video';
        if($key != 0){
          echo' hidden';
        };
        echo '" data-example="' . $key . '">';
        echo '<div class="video-wrap">';
        echo '<canvas width="634" height="355"></canvas>';

        // Add thumbnail image
        echo '<video poster="' . wp_get_attachment_url( $example_thumbnail ) . '" controls>';
        // Add mp4 video
        if( !empty( $item->video->mp4 ) ) {
          echo '<source src="' . wp_get_attachment_url( $item->video->mp4 ) . '">';
        }
        // Add web video
        if( !empty( $item->video->webm ) ) {
          echo '<source src="' . wp_get_attachment_url( $item->video->webm ) . '">';
        }

        echo '</video>';
        echo '</div>';
        echo '</div>';
      }

    }
    // To stop the old examples being rendered
    return;
  }

  /* To be depreciated in 0.3.0 */

  $old_example_items = get_post_meta( $post->ID, '_example_1_url_video', TRUE );
  $_example_limit = 2;
  $_formats = array( 'mp4', 'webm' );

  if ( isset( $old_example_items ) ) {

    // Build each example
    for ($i = 0; $i <= $_example_limit; $i++) {

      $_temp = ($i + 1);


      // Build each video
      if(!empty($custom['_example_' . $_temp . '_url_video']) && $custom['_example_' . $_temp . '_url_video'][0] != '0') {

        echo '<div class="example__video';
        if($i != 0){
          echo' hidden';
        };
        echo '" data-example="' . $i . '">';
        // This makes our thumbnail image backwards compatible with 0.1.0
        if( !isset( $custom['_example_thumbnail'][0] ) ) {
          $_example_video = urldecode( $custom['_example_' . $_temp . '_url_video'][0] );
        } else {
        // Version 0.2.0
          $_example_video = wp_get_attachment_url( $custom['_example_thumbnail'][0] );
        }


        echo '<div class="video-wrap">';

        echo '<canvas width="634" height="355"></canvas>';
        echo '<video poster="' . $_example_video . '" controls>';

        // Return each video if available
        foreach ($_formats as $value) {
          if(!empty($custom['_example_' . $_temp . '_url_'.$value][0])) {
            $_format_type = urldecode( $custom['_example_' . $_temp . '_url_'.$value][0] );
            echo '<source src="' . $_format_type . '">';
          };

        };

        unset($value);

        echo '<div class="alert alert--message alert--info"><p><strong>Video Not Available.</strong> The browser you are using does not support HTML5 video. Please try viewing this page in an updated browser.</p></div>';
        echo '</video>';
        echo '</div>';
        echo '</div>';

      }

    }
  }

}
