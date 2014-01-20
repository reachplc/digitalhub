<?php

/**
 *  Function to check to see if there are examples
 *
 *  returns boolean
 */

function is_example() {

  return true;

}


/**
 *
 */

function get_example_preview($custom) {

  if(!empty($custom['_example_1_url_preview']) && $custom['_example_1_url_preview'][0] != '0') {

    $_example_preview = urldecode( $custom['_example_1_url_preview'][0] );

    echo '<li><a href="#"><img src="' .$_example_preview . '"></a></li>';
  }

  if(!empty($custom['_example_2_url_preview']) && $custom['_example_2_url_preview'][0] != '0') {

    $_example_video = urldecode( $custom['_example_2_url_preview'][0] );

    echo '<li><a href="#"><img src="' .$_example_preview . '"></a></li>';
  }

  if(!empty($custom['_example_3_url_preview']) && $custom['_example_3_url_preview'][0] != '0') {

    $_example_video = urldecode( $custom['_example_3_url_preview'][0] );

    echo '<li><a href="#"><img src="' .$_example_preview . '"></a></li>';
  }

}

/**
 *
 */

function get_example_video($custom) {

  //  Example Adverts

  if(!empty($custom['_example_1_url_video']) && $custom['_example_1_url_video'][0] != '0') {

    $_example_video = urldecode( $custom['_example_1_url_video'][0] );
    $_example_mp4 = urldecode( $custom['_example_1_url_mp4'][0] );
    $_example_webm = urldecode( $custom['_example_1_url_webm'][0] );
    $_example_ogg = urldecode( $custom['_example_1_url_ogg'][0] );
    $_example_flv = urldecode( $custom['_example_1_url_flv'][0] );
    echo '<div class="example">';
    echo '<video class="example__video" poster="' . $_example_video . '" controls>';
    echo '<source src="' . $_example_mp4 . '">';
    echo '<source src="' . $_example_webm . '">';
    echo '<source src="' . $_example_ogg . '">';
    echo '<p>This is fallback content</p>';
    echo '</video>';
    echo '</div>';
  }

  if(!empty($custom['_example_2_url_video']) && $custom['_example_2_url_video'][0] != '0') {

    $_example_video = urldecode( $custom['_example_2_url_video'][0] );
    $_example_mp4 = urldecode( $custom['_example_2_url_mp4'][0] );
    $_example_webm = urldecode( $custom['_example_2_url_webm'][0] );
    $_example_ogg = urldecode( $custom['_example_2_url_ogg'][0] );
    $_example_flv = urldecode( $custom['_example_2_url_flv'][0] );
    echo '<div class="example-video example_video--active">';
    echo '<video poster="' . $_example_video . '" controls>';
    echo '<source src="' . $_example_mp4 . '">';
    echo '<source src="' . $_example_webm . '">';
    echo '<source src="' . $_example_ogg . '">';
    echo '<p>This is fallback content</p>';
    echo '</video>';
    echo '</div>';
  }

  if(!empty($custom['_example_3_url_video']) && $custom['_example_3_url_video'][0] != '0') {

    $_example_video = urldecode( $custom['_example_3_url_video'][0] );
    $_example_mp4 = urldecode( $custom['_example_3_url_mp4'][0] );
    $_example_webm = urldecode( $custom['_example_3_url_webm'][0] );
    $_example_ogg = urldecode( $custom['_example_3_url_ogg'][0] );
    $_example_flv = urldecode( $custom['_example_3_url_flv'][0] );
    echo '<div class="example-video example_video--active">';
    echo '<video poster="' . $_example_video . '" controls>';
    echo '<source src="' . $_example_mp4 . '">';
    echo '<source src="' . $_example_webm . '">';
    echo '<source src="' . $_example_ogg . '">';
    echo '<p>This is fallback content</p>';
    echo '</video>';
    echo '</div>';
  }

}
