<?php

add_filter( 'pre_get_posts', 'per_category_basis' );

function additional_active_item_classes($classes = array(), $menu_item = false){
	global $wp_query;

	if ( in_array( 'current-menu-item', $menu_item->classes ) ){
		$classes[] = 'current-menu-item';
	}

	if ( $menu_item->post_name == 'adverts' && is_post_type_archive( 'adverts' ) ) {
		$classes[] = 'current-menu-item';
	}

	if ( $menu_item->post_name == 'adverts' && is_singular( 'adverts' ) ) {
		$classes[] = 'current-menu-item';
	}

	// Packages
	// TODO: Find a replacement for using the id as the post name

	if ( $menu_item->post_name == '87' && is_tax( 'packages' ) ){
		$classes[] = 'current-menu-item';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'additional_active_item_classes', 10, 2 );
	?>