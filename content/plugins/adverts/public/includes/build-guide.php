<?php

/**
 *  Function to check to see if there are examples
 *
 *  returns boolean
 */

function is_buildGuide() {

	global $post;

	$key = '_build_guide';
	$disabled = get_post_meta( $post->ID, '_build_guide_disabled', true );
	$options = get_option( 'adverts-settings' );

	// Test for build guide disabled in advert option
	if ( $disabled == true ) {
		return false;
	}

	// Test for local build guide (added to post)
	if ( get_post_meta( $post->ID, $key, true ) != '' ) {
		return true;
	}

	// Test for global guide (added to settings)
	if ( $options['_build_guide'] && $options['_build_guide'] != '' ) {
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

	$key = '_build_guide';
	$options = get_option( 'adverts-settings' );

	// Return local build guide (added to post)
	if ( get_post_meta( $post->ID, $key, true ) != '' ) {
		echo esc_url( get_post_meta( $post->ID, $key, true ) );
		return;
	}

	// Return global guide (added to settings)
	if ( $options['_build_guide'] && $options['_build_guide'] != '' ) {
		echo esc_url( $options['_build_guide'] );
		return;
	}

}
