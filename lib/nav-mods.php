<?php
/**
 * Cleans up the nav menu markup.
 *
 * @package BLR_Base_Theme\Nav
 */

namespace BLR_Base_Theme\Nav;

add_filter( 'wp_nav_menu_args', __NAMESPACE__ . '\\nav_menu_args' );
add_filter( 'nav_menu_item_id', '__return_null' );
add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\\nav_menu_item_class', 10, 2 );
add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\\nav_menu_link_attributes', 10, 2 );


/**
 * Cleans up wp_nav_menu_args. Removes the menu container and removes the
 * id attribute on nav menu items.
 *
 * @since 0.3.0
 *
 * @param array $args The nav menu arguments.
 * @return array
 */
function nav_menu_args( $args = '' ) {

	$args['container'] = false;
	$args['items_wrap'] = '<ul class="menu">%3$s</ul>';

	return $args;
}

/**
 * Removes unnecessary classes and replaces all the "current-menu-*" and
 * "current-page-*" classes with a single "is-active" class.
 *
 * @since 0.3.0
 *
 * @param array  $classes An array containing the default nav menu item classes.
 * @param object $item    An object containing the nav menu item data.
 * @return array
 */
function nav_menu_item_class( $classes, $item ) {

	$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'is-active', $classes );
	$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );
	$classes = preg_replace( '/^active/', 'is-active', $classes );

	$classes[] = 'menu__item';

	return array_filter( array_unique( $classes ), function( $element ) {
		$element = trim( $element );
		return ( ! empty( $element ) );
	});
}

/**
 * Replaces the default menu link class and adds a role to each link.
 *
 * @since 0.3.0
 *
 * @param array  $atts An array containing the menu link HTML attributes.
 * @param object $item An object containing the menu link data.
 * @return array
 */
function nav_menu_link_attributes( $atts, $item ) {
	$atts['class'] = 'menu__link';
	$atts['role']  = 'menuitem';

	return $atts;
}