<?php
/**
 * Cleans up the nav menu markup.
 *
 * @package BLR\Base_Theme\Nav
 */

namespace BLR\Base_Theme\Nav;

/**
 * Custom nav walker.
 */
class Nav_Walker extends \Walker_Nav_Menu {

	/**
	 * The archive URL for the current post type.
	 *
	 * @var string
	 */
	protected $archive_url;

	/**
	 * Class constructor.
	 */
	public function __construct() {

		add_filter( 'nav_menu_item_id', '__return_null' );
		add_filter( 'nav_menu_css_class', [ $this, 'menu_item_classes' ], 10, 2 );
		add_filter( 'nav_menu_link_attributes', [ $this, 'menu_link_atts' ], 10, 2 );

		$this->archive_url = get_post_type_archive_link( get_post_type() );
	}

	/**
	 * Displays the nav menu item.
	 *
	 * @param  object  $element           The current menu item.
	 * @param  array   $children_elements The nav menu child elements.
	 * @param  array   $max_depth         The max menu depth.
	 * @param  integer $depth             The current menu depth.
	 * @param  array   $args              The nav menu args.
	 * @param  string  $output            The nav menu output.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		$element->has_children = (
			isset( $children_elements[ $element->ID ] )
			&& ! empty( $children_elements[ $element->ID ] )
			&& ( $depth + 1 < $max_depth || 0 === $max_depth )
		);

		$element->is_sub_menu_item = ( $depth > 0 );

		$element->is_active = (
			! empty( $element->url )
			&& $this->url_compare( $this->archive_url, $element->url )
		);

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Removes unnecessary classes and replaces all the `current-menu-*` and
	 * `current-page-*` classes with a single `is-active` class. Also adds a
	 * `has-children` class for menu items with sub-menus.
	 *
	 * @since 0.3.0
	 *
	 * @param array  $classes An array containing the default nav menu item classes.
	 * @param object $item    An object containing the nav menu item data.
	 * @return array
	 */
	public function menu_item_classes( $classes, $item ) {

		// Remove core classes.
		$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'is-active', $classes );
		$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );
		$classes = preg_replace( '/^active/', 'is-active', $classes );

		// Add base menu item class.
		$classes[] = 'menu__item';

		// Add active class in cases where WP doesn't set it properly.
		if ( $item->is_active ) {
			$classes[] = 'is-active';
		}

		// Add `is-sub-menu-item` class.
		if ( $item->is_sub_menu_item ) {
			$classes[] = 'is-sub-menu-item';
		}

		// Add `has-children` class.
		if ( $item->has_children ) {
			$classes[] = 'has-children';
		}

		// Filter duplicate / empty classes.
		$classes = array_map( 'trim', $classes );
		$classes = array_unique( $classes );
		$classes = array_filter( $classes );

		return $classes;
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
	public function menu_link_atts( $atts, $item ) {

		$atts['class'] = 'menu__link';
		$atts['role']  = 'menuitem';

		return $atts;
	}

	/**
	 * Make a URL relative.
	 *
	 * @param string $input The URL to make relative.
	 */
	protected function make_url_relative( $input ) {
		if ( is_feed() ) {
			return $input;
		}

		$url = parse_url( $input );
		if ( ! isset( $url['host'] ) || ! isset( $url['path'] ) ) {
			return $input;
		}

		$site_url = parse_url( network_home_url() );

		if ( ! isset( $url['scheme'] ) ) {
			$url['scheme'] = $site_url['scheme'];
		}

		$hosts_match   = $site_url['host'] === $url['host'];
		$schemes_match = $site_url['scheme'] === $url['scheme'];
		$ports_exist   = isset( $site_url['port'] ) && isset( $url['port'] );
		$ports_match   = ( $ports_exist ) ? $site_url['port'] === $url['port'] : true;

		if ( $hosts_match && $schemes_match && $ports_match ) {
			return wp_make_link_relative( $input );
		}

		return $input;
	}

	/**
	 * Compare a relative or absolute URL against a relative URL.
	 *
	 * @param string $url The URL to compare against.
	 * @param string $rel The relative URL to compare against.
	 * @return bool
	 */
	protected function url_compare( $url, $rel ) {
		$url = trailingslashit( $url );
		$rel = trailingslashit( $rel );

		$abs_match = ( strcasecmp( $url, $rel ) === 0 );
		$rel_match = ( $rel === $this->make_url_relative( $url ) );

		return ( $abs_match || $rel_match );
	}
}

add_filter( 'wp_nav_menu_args', __NAMESPACE__ . '\\nav_menu_args' );
add_filter( 'nav_menu_item_id', '__return_null' );

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

	$args['container']  = false;
	$args['items_wrap'] = '<ul class="menu">%3$s</ul>';

	if ( ! $args['walker'] ) {
		$args['walker'] = new Nav_Walker();
	}

	return $args;
}
