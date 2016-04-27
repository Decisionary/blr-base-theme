<?php
/**
 * Theme setup.
 *
 * @package BLR_Base_Theme\Setup
 */

namespace BLR_Base_Theme\Setup;

use BLR_Base_Theme\Assets;

/**
 * Theme setup
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
 * Register sidebars
 */
function widgets_init() {

	register_sidebar([
		'name'          => __( 'Primary', 'blr-base-theme' ),
		'id'            => 'sidebar-primary',
		'description'   => __( 'The left navigation sidebar in a BLR theme', 'blr-base-theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	]);

	register_sidebar([
		'name'          => __( 'Secondary', 'blr-base-theme' ),
		'id'            => 'sidebar-secondary',
		'description'   => __( 'The right sidebar sidebar in a BLR theme', 'blr-base-theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	]);

	register_sidebar([
		'name'          => __( 'Pre-Header', 'blr-base-theme' ),
		'id'            => 'sidebar-pre-header',
		'description'   => __( 'The space above the header in a BLR theme', 'blr-base-theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	]);

	register_sidebar([
		'name'          => __( 'Footer', 'blr-base-theme' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	]);

	register_sidebar([
		'name'          => __( 'Post-Footer', 'blr-base-theme' ),
		'id'            => 'sidebar-post-footer',
		'description'   => __( 'The area after the footer in a BLR theme', 'blr-base-theme' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	]);
}

add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );

/**
 * Determine whether to show a specific sidebar.
 *
 * @param string $sidebar (optional) The sidebar ID. Defaults to 'sidebar-primary'.
 */
function display_sidebar( $sidebar = 'sidebar-primary' ) {

	static $display;

	// Sidebar will be hidden if any of the following is true.
	$hide_criteria = [
		( ! is_active_sidebar( $sidebar ) ),
		is_404(),
		is_front_page(),
	];

	isset( $display ) || $display = ( ! in_array( true, $hide_criteria, true ) );

	return apply_filters( 'blr-base-theme/display_sidebar', $sidebar, $display );
}

/**
 * Determine whether to show a specific nav menu.
 *
 * @param string $menu (optional) The nav menu ID. Defaults to 'nav-primary'.
 */
function display_nav_menu( $menu = 'nav-primary' ) {

	static $display;

	// Nav menu will be hidden if any of the following is true.
	$hide_criteria = [
		( ! has_nav_menu( $menu ) ),
	];

	isset( $display ) || $display = ( ! in_array( true, $hide_criteria, true ) );

	return apply_filters( 'blr-base-theme/display_nav_menu', $menu, $display );
}

/**
 * Theme assets
 */
function assets() {

	wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css' );

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );
