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
	add_theme_support( 'soil-nav-walker' );
	add_theme_support( 'soil-nice-search' );
	add_theme_support( 'soil-jquery-cdn' );
	add_theme_support( 'soil-relative-urls' );

	// Make theme available for translation.
	load_theme_textdomain( 'blr-base-theme', get_template_directory() . '/lang' );

	// Enable plugins to manage the document title.
	add_theme_support( 'title-tag' );

	// Register wp_nav_menu() menus.
	register_nav_menus([
		'primary_navigation' => __( 'Primary Navigation', 'blr-base-theme' ),
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
}

add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
	static $display;

	// The sidebar will NOT be displayed if ANY of the following return true.
	$criteria = [
		is_404(),
		is_front_page(),
		is_page_template( 'template-custom.php' ),
	];

	isset( $display ) || $display = ! in_array( true, $criteria, true );

	return apply_filters( 'blr-base-theme/display_sidebar', $display );
}

/**
 * Theme assets
 */
function assets() {

	wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css' );
	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css' );
	wp_enqueue_style( 'blr/main', Assets\asset_url( 'css/app.css' ), false, null );

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'blr/main', Assets\asset_url( 'js/app.js' ), [ 'jquery' ], null, true );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );
