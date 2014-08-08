<?php

/**
 *  Function to check to see if there are examples
 *
 *  returns boolean
 */

function is_buildGuide() {

  global $post;

  $key = 'document_file_id';
  $disabled = get_post_meta($post->ID, '_build_guide_disabled', TRUE);
  $options = get_option( 'adverts-settings' );

  // Test for build guide disabled in advert option
  if ( $disabled == true ) {
    return false;
  }

  // Test for local build guide (added to post)
  if( get_post_meta($post->ID, $key, TRUE) != '' ) {
    return true;
  }

  // Test for global guide (added to settings)
  if( $options['build_guide'] && $options['build_guide'] != '' ) {
    return true;
  }

  // No build guide found
  return false;

}


/**
 *  Return the url for custom meta
 */

function the_buildGuide() {

  global $post;

  $key = 'document_file_id';
  $options = get_option( 'adverts-settings' );

  // Return local build guide (added to post)
  if( get_post_meta($post->ID, $key, TRUE) != '' ) {
    echo wp_get_attachment_url( get_post_meta($post->ID, $key, TRUE) );
    return;
  }

  // Return global guide (added to settings)
  if( $options['build_guide'] && $options['build_guide'] != '' ) {

    $attachment_id = (int) $options['build_guide'];
    echo wp_get_attachment_url( $attachment_id );
    return;
  }

}
