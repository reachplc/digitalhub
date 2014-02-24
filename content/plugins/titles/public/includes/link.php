<?php

/**
 *  Function to check to see if there are examples
 *
 *  returns boolean
 */

function have_link() {

  global $post;

  $_key = '_link';
  $_link = get_post_meta($post->ID, $_key, TRUE);

  if(!empty($_link)) {
  return true;
  } else {
    return false;
  }

}

/**
 *  Return the url for custom meta
 */

function the_link() {

  global $post;
  $_key = '_link';
  $_link = get_post_meta($post->ID, $_key, TRUE);

  echo urldecode($_link);

}