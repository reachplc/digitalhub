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


/**
 * To be depreciated in 0.3.0
 */

for ($i = 1; $i <= $example_limit; $i++) {

  /* Formats allowed */
  $_formats = array( 'mp4', 'webm' );

  // Preview image
  $placeholder_meta_value = ( isset( $_POST[ '_example_' . $i .'_url_preview' ] ) ? urlencode( $_POST[ '_example_' . $i .'_url_preview' ] ) : '' );

    $meta_key = '_example_' . $i .'_url_preview' ;

    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $placeholder_meta_value && '' == $meta_value ) {
      add_post_meta( $post_id, $meta_key, $placeholder_meta_value, true );
    }
    /* If the new meta value does not match the old value, update it. */
    elseif ( $placeholder_meta_value && $placeholder_meta_value != $meta_value ) {
      update_post_meta( $post_id, $meta_key, $placeholder_meta_value );
    }
    /* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $placeholder_meta_value && $meta_value ) {
      delete_post_meta( $post_id, $meta_key, $meta_value );
    }

  // Video Placeholder

  $new_meta_value = ( isset( $_POST[ '_example_' . $i .'_url_video' ] ) ? urlencode( $_POST[ '_example_' . $i .'_url_video' ] ) : '' );

    $meta_key = '_example_' . $i .'_url_video' ;

    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && '' == $meta_value ) {
      add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    }
    /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
      update_post_meta( $post_id, $meta_key, $new_meta_value );
    }
    /* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $new_meta_value && $meta_value ) {
      delete_post_meta( $post_id, $meta_key, $meta_value );
    }

  // Videos

  foreach ($_formats as $value) {
    $new_meta_value = ( isset( $_POST['_example_' . $i . '_url_' . $value ] ) ? urlencode( $_POST['_example_' . $i . '_url_' . $value ] ) : '' );

    $meta_key = '_example_' . $i . '_url_' . $value ;

    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && '' == $meta_value ) {
      add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    }
    /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
      update_post_meta( $post_id, $meta_key, $new_meta_value );
    }
    /* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $new_meta_value && $meta_value ) {
      delete_post_meta( $post_id, $meta_key, $meta_value );
    }

  }

  unset($value);

}
