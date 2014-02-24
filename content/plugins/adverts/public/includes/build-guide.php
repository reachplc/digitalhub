<?php

/**
 *  Function to check to see if there are examples
 *
 *  returns boolean
 */

function is_buildGuide() {

  global $post;

  $key = 'document_file_id';
  $buildGuide = get_post_meta($post->ID, $key, TRUE);

  if($buildGuide != '') {
  return true;
  } else {
    return false;
  }

}


/**
 *  Return the url for custom meta
 */

function the_buildGuide() {

  global $post;
  $key = 'document_file_id';
  $buildGuide = get_post_meta($post->ID, $key, TRUE);

  echo wp_get_attachment_url($buildGuide);

}
