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

  //
  $package_count = count($posts);

  if ( $current_package +1 <= $package_count ) {
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

  global $taxonomy_type;
  global $current_package;

  $terms = get_terms($taxonomy_type);

  echo $terms[$current_package -1]->name;

}

function the_package_description() {

  global $taxonomy_type;
  global $current_package;

  $terms = get_terms($taxonomy_type);

  echo $terms[$current_package -1]->description;

}

function the_package_link() {

  global $taxonomy_type;
  global $current_package;

  $terms = get_terms($taxonomy_type);

  $slug = $terms[$current_package -1]->slug;
  echo trailingslashit(home_url()) . trailingslashit('packages') . trailingslashit($slug);

}

function the_package_image() {

  global $taxonomy_type;
  global $current_package;

  $terms = get_terms($taxonomy_type);

  $slug = $terms[$current_package -1]->slug;

  echo get_stylesheet_directory_uri() . '/images/' . $slug . '.png';

}

/**
 *
 */

function have_package_page() {
  global $current_package_post;
  global $pages;

  $package_post_count = count($pages);

  if ( $current_package_post +1 <= $package_post_count ) {
    return true;
  } else {
    return false;
  }

}

function the_package_page() {
  global $current_package_post;
  $current_package_post++;
}

function the_package_page_title() {

  global $pages;
  global $current_package_post;

  echo $pages[$current_package_post-1]->post_title;

}

function the_package_page_description() {

  global $pages;
  global $current_package_post;

  echo $pages[$current_package_post-1]->post_content;

}

function the_package_page_link() {

  global $pages;
  global $current_package_post;
  $slug = $pages[$current_package_post-1]->post_name;
  echo trailingslashit(home_url()) . trailingslashit('packages') . trailingslashit($slug);

}

function the_package_page_image() {

  global $pages;
  global $current_package_post;

  $slug = $pages[$current_package_post-1]->post_name;

  echo get_stylesheet_directory_uri() . '/images/' . $slug . '.png';

}
