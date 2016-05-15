<?php
/**
 * Theme setup.
 *
 * @package BLR\Base_Theme\Setup
 */

namespace BLR\Base_Theme\Setup;

use BLR\Base_Theme\Assets;

/**
 * Theme setup.
 *
 * @since 0.1.0
 */
function setup() {

	// Enable features from Soil when plugin is activated.
	add_theme_support( 'soil-clean-up' );
	add_theme_support( 'soil-nice-search' );
	add_theme_support( 'soil-jquery-cdn' );
	add_theme_support( 'soil-relative-urls' );

	// Make theme available for translation.
	load_theme_textdomain( 'blr-base-theme', get_template_directory() . '/lang' );

	// Enable plugins to manage the document title.
	add_theme_support( 'title-tag' );

	// Enable Selective Refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Register wp_nav_menu() menus.
	register_nav_menus([
		'nav-primary' => __( 'Header Primary Menu', 'blr-base-theme' ),
		'nav-search'  => __( 'Header Search Menu', 'blr-base-theme' ),
		'nav-sidebar' => __( 'Sidebar Menu', 'blr-base-theme' ),
		'nav-footer'  => __( 'Footer Menu', 'blr-base-theme' ),
	]);

	// Enable post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Enable post formats.
	add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ] );

	// Enable HTML5 markup support.
	add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

	// Use main stylesheet for visual editor.
	add_editor_style( Assets\asset_url( 'css/app.css' ) );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
function widgets_init() {

	$defaults = [
		'before_widget' => '<section class="widget--boxed %1$s %2$s">',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3><div class="widget__content">',
		'after_widget'  => '</div></section>',
	];

	register_sidebar(
		wp_parse_args( $defaults, [
			'name'        => __( 'Primary', 'blr-base-theme' ),
			'id'          => 'sidebar-primary',
			'description' => __( 'The left navigation sidebar in a BLR theme', 'blr-base-theme' ),
		])
	);

	register_sidebar(
		wp_parse_args( $defaults, [
			'name'        => __( 'Secondary', 'blr-base-theme' ),
			'id'          => 'sidebar-secondary',
			'description' => __( 'The right sidebar sidebar in a BLR theme', 'blr-base-theme' ),
		])
	);

	register_sidebar(
		wp_parse_args( $defaults, [
			'name'        => __( 'Pre-Header', 'blr-base-theme' ),
			'id'          => 'sidebar-pre-header',
			'description' => __( 'The space above the header in a BLR theme', 'blr-base-theme' ),
		])
	);

	register_sidebar(
		wp_parse_args( $defaults, [
			'name' => __( 'Footer', 'blr-base-theme' ),
			'id'   => 'sidebar-footer',
		])
	);

	register_sidebar(
		wp_parse_args( $defaults, [
			'name'        => __( 'Post-Footer', 'blr-base-theme' ),
			'id'          => 'sidebar-post-footer',
			'description' => __( 'The area after the footer in a BLR theme', 'blr-base-theme' ),
		])
	);
}

add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );

/**
 * Determine whether to show a specific sidebar.
 *
 * @since 0.1.0
 *
 * @param string $sidebar (optional) The sidebar ID. Defaults to 'sidebar-primary'.
 * @return bool
 */
function display_sidebar( $sidebar = 'sidebar-primary' ) {

	// Sidebar will be hidden if any of the following is true.
	$hide_criteria = [
		( ! is_active_sidebar( $sidebar ) && 'sidebar-secondary' !== $sidebar ),
		is_404(),
	];

	$display = ( ! in_array( true, $hide_criteria, true ) );
	$display = apply_filters( 'blr-base-theme/display_sidebar', $display, $sidebar );
	$display = apply_filters( 'blr/display_sidebar', $display, $sidebar );

	return $display;
}

/**
 * Determine whether to show a specific nav menu.
 *
 * @since 0.1.0
 *
 * @param string $menu (optional) The nav menu ID. Defaults to 'nav-primary'.
 * @return bool
 */
function display_nav_menu( $menu = 'nav-primary' ) {

	// Nav menu will be hidden if any of the following is true.
	$hide_criteria = [
		( ! has_nav_menu( $menu ) ),
	];

	$display = ( ! in_array( true, $hide_criteria, true ) );
	$display = apply_filters( 'blr-base-theme/display_nav_menu', $display, $menu );
	$display = apply_filters( 'blr/display_nav_menu', $display, $menu );

	return $display;
}

/**
 * Determine whether to show the breadcrumbs section.
 *
 * @since 0.6.0
 *
 * @return bool
 */
function display_breadcrumbs() {

	// Nav menu will be hidden if any of the following is true.
	$hide_criteria = [
		( ! is_callable( 'bcn_display' ) )
	];

	$display = ( ! in_array( true, $hide_criteria, true ) );
	$display = apply_filters( 'blr/display_breadcrumbs', $display );

	return $display;
}

/**
 * Theme assets.
 *
 * @since 0.1.0
 */
function assets() {

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );
