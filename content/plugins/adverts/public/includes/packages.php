<?php

/**
 *  Function to check to see if there are packages
 *
 *  returns boolean
 */

function have_packages() {

  global $taxonomy_type;
  global $current_package;
  global $posts;

  $package_count = count($posts);

  if ( $current_package+1 <= $package_count ) {
    return true;
  } else {
    return false;
  }

}

/**
 * Get all preview images
 *
 * @since    0.1.0
 *
 * @param $custom The array returned by get_post_custom.
 */


function the_packages() {
  global $current_package;
  $current_package++;
}

function the_package_title() {

  global $terms;
  global $current_package;

  echo $terms[$current_package]->name;

}

function the_package_description() {

  global $terms;
  global $current_package;

  echo $terms[$current_package]->description;

}

function the_package_link() {

  global $terms;
  global $current_package;

  $slug = $terms[$current_package]->slug;
  echo trailingslashit(home_url()) . trailingslashit('packages') . trailingslashit($slug);

}

function the_package_image() {

  global $terms;
  global $current_package;

  $slug = $terms[$current_package]->slug;

  echo get_stylesheet_directory_uri() . '/images/' . $slug . '.png';

}
