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
  $_example_limit = 3;
  $custom = get_post_custom( $post->ID );
  // Get item meta data
  $example_item = json_decode( get_post_meta($post->ID, '_example_item', TRUE ) );
  $old_example_items = get_post_meta( $post->ID, '_example_1_url_video', TRUE );

  if ( isset( $example_item ) ) {
    //print_r($example_item);

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
    for ($i = 1; $i <= $_example_limit; $i++) {

      if(!empty($custom['_example_' . $i . '_url_preview']) && $custom['_example_' . $i . '_url_preview'][0] != '0') {

        $_example_preview = urldecode( $custom['_example_' . $i . '_url_preview'][0] );

      echo '<li class="js-example-preview';
      if ($i == 1){echo ' example__preview--selected';}
      echo '"><span class="sprite sprite--play icon icon__overlay';
      if ($i == 1){echo ' hidden';}
      echo '"></span><img class="example__preview--image" data-example="' . $i . '" src="' .$_example_preview . '"></li>';
      }

    }
  }

}

/**
 *
 */

function get_example_video($custom) {

  global $post;
  $_example_limit = 3;
  $_formats = array( 'mp4', 'webm' );

  // Build each example
  for ($i = 1; $i <= $_example_limit; $i++) {

    // Build each video
    if(!empty($custom['_example_' . $i . '_url_video']) && $custom['_example_' . $i . '_url_video'][0] != '0') {

      echo '<div class="example__video';
      if($i != 1){
        echo' hidden';
      };
      echo '" data-example="' . $i . '">';
      // This makes our thumbnail image backwards compatible with 0.1.0
      if( !isset( $custom['_example_thumbnail'][0] ) ) {
        $_example_video = urldecode( $custom['_example_' . $i . '_url_video'][0] );
      } else {
      // Version 0.2.0
        $_example_video = wp_get_attachment_url( $custom['_example_thumbnail'][0] );
      }


      echo '<div class="video-wrap">';

      echo '<canvas width="634" height="355"></canvas>';
      echo '<video poster="' . $_example_video . '" controls>';

      // Return each video if available
      foreach ($_formats as $value) {
        if(!empty($custom['_example_' . $i . '_url_'.$value][0])) {
          $_format_type = urldecode( $custom['_example_' . $i . '_url_'.$value][0] );
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
