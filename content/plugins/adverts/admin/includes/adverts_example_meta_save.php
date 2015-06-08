<?php

global $post;
$example_limit = 3;

/* Verify the nonce before proceeding. */
if ( !isset( $_POST['example_inner_build_guide_box_nonce'] ) || !wp_verify_nonce($_POST['example_inner_build_guide_box_nonce'],'example_inner_build_guide_box') ) {
  return $post_id;
}

// Has the user permission to edit this page/post?
if(strtolower($_POST['post_type']) === 'adverts') {
  if(!current_user_can('edit_page', $post_id)) {
      return $post_id;
  }
} else {
  if(!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }
}


/**
 * Add thumbnail image to the database
 */

$thumbnail_meta_key = '_example_thumbnail' ;
$thumbnail_meta_check = ( isset( $_POST[ $thumbnail_meta_key ] ) ? urlencode( $_POST[ $thumbnail_meta_key ] ) : '' );
$thumbnail_meta_value = get_post_meta( $post_id, $thumbnail_meta_key, true );

/* If a new meta value was added and there was no previous value, add it. */
if ( $thumbnail_meta_check && '' == $thumbnail_meta_value ) {
  add_post_meta( $post_id, $thumbnail_meta_key, $thumbnail_meta_check, true );
}
/* If the new meta value does not match the old value, update it. */
elseif ( $thumbnail_meta_check && $thumbnail_meta_check != $thumbnail_meta_value ) {
  update_post_meta( $post_id, $thumbnail_meta_key, $thumbnail_meta_check );
}
/* If there is no new meta value but an old value exists, delete it. */
elseif ( '' == $thumbnail_meta_check && $thumbnail_meta_value ) {
  delete_post_meta( $post_id, $thumbnail_meta_key, $thumbnail_meta_check );
}

/**
 * Store posts example data
 */

$example_meta_key = '_example_item';
$example_meta_check = ( isset( $_POST[ $example_meta_key ] ) ? json_encode( $_POST[ $example_meta_key ] ) : '' );
$example_meta_value = get_post_meta( $post_id, $example_meta_key, true );

/* If a new meta value was added and there was no previous value, add it. */
if ( $example_meta_check && '' == $example_meta_value ) {
  add_post_meta( $post_id, $example_meta_key, $example_meta_check, true );
}
/* If the new meta value does not match the old value, update it. */
elseif ( $example_meta_check && $example_meta_check != $example_meta_value ) {
  update_post_meta( $post_id, $example_meta_key, $example_meta_check );
}
/* If there is no new meta value but an old value exists, delete it. */
elseif ( '' == $example_meta_check && $example_meta_value ) {
  delete_post_meta( $post_id, $example_meta_key, $example_meta_check );
}
