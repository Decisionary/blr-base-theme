<?php
/**
 * Theme extras.
 *
 * @package BLR\Base_Theme\Extras
 */

namespace BLR\Base_Theme\Extras;

use BLR\Base_Theme\Setup;

/**
 * Add <body> classes.
 *
 * @since 0.1.0
 *
 * @param array $classes The current set of <body> classes.
 */
function body_class( $classes ) {

	// Add page slug if it doesn't exist.
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = basename( get_permalink() );
	}

	// Add page layout classes.
	if ( Setup\display_sidebar( 'sidebar-primary' ) ) {
		$classes[] = 'has-sidebar-primary';
	}

	if ( Setup\display_sidebar( 'sidebar-secondary' ) ) {
		$classes[] = 'has-sidebar-secondary';
	}

	if ( Setup\display_breadcrumbs() ) {
		$classes[] = 'has-breadcrumbs';
	}

	if ( get_theme_mod( 'blr_base_theme_logo_primary_enabled', '1' ) ) {
		$classes[] = 'has-header-right-logo';
	}

	// Remove any duplicate entries.
	$classes = array_unique( $classes );

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Add post classes.
 *
 * @since 0.1.0
 *
 * @param array $classes The current set of post classes.
 */
function post_class( $classes ) {

	$classes[] = 'entry';
	$classes[] = 'content-section';

	return $classes;
}

add_filter( 'post_class', __NAMESPACE__ . '\\post_class' );

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
	return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'blr-base-theme' ) . '</a>';
}

add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );

// Add our function to the sage/wrap_base filter.
add_filter( 'blr-base-theme/wrap_base', __NAMESPACE__ . '\\wrap_base_cpts' );

function wrap_base_cpts( $templates ) {

	if ( is_a( get_queried_object(), 'WP_Term' ) ) {
		return $templates;
	}

	// Get the current post type.
	$cpt = get_post_type();

	if ( $cpt ) {

		// Shift the template to the front of the array.
		array_unshift( $templates, 'base-' . $cpt . '.php' );
	}

	// Return our modified array with base-$cpt.php at the front of the queue.
	return $templates;
}
