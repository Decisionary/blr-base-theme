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
