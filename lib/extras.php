<?php
/**
 * Theme extras.
 *
 * @package BLR_Base_Theme\Extras
 */

namespace BLR_Base_Theme\Extras;

use BLR_Base_Theme\Setup;

/**
 * Add <body> classes.
 *
 * @since 0.1.0
 *
 * @param array $classes The current set of <body> classes.
 */
function body_class( $classes ) {

	// Add page slug if it doesn't exist.
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	// Add page layout classes.
	if ( Setup\display_sidebar( 'sidebar-primary' ) ) {
		$classes[] = 'has-sidebar-primary';
	}
	if ( Setup\display_sidebar( 'sidebar-secondary' ) ) {
		$classes[] = 'has-sidebar-secondary';
	}

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
	return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'blr-base-theme' ) . '</a>';
}

add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );
