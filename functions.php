<?php
/**
 * Theme includes.
 *
 * The $includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @package BLR_Base_Theme\Includes
 */

define( 'THEME_NAME', 'blr-base-theme' );

$includes = [
	'lib/assets.php',  // Scripts and stylesheets.
	'lib/extras.php',  // Custom functions.
	'lib/setup.php',   // Theme setup.
	'lib/titles.php',  // Page titles.
	'lib/wrapper.php', // Theme wrapper class.
	'lib/customizer.php', // Theme customizer.
];

foreach ( $includes as $file ) {

	$file_path = locate_template( $file );

	if ( ! $file_path ) {
		$error_message = sprintf( __( 'Error locating %s for inclusion', 'blr-base-theme' ), $file );
		trigger_error( esc_html( $error_message ), E_USER_ERROR );
	}

	require_once $file_path;
}
unset( $file, $file_path );

function blr_base_theme_register_sidebars() {
	register_sidebar(
		[
			'name'          => __( 'Left Nav', THEME_NAME ),
			'id'            => 'nav-1',
			'description'   => __( 'The left navigation sidebar in a BLR theme', THEME_NAME ),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget'  => '</aside>',
		]
	);

	register_sidebar(
		[
			'name'          => __( 'Right Sidebar', THEME_NAME ),
			'id'            => 'sidebar-1',
			'description'   => __( 'The right sidebar sidebar in a BLR theme', THEME_NAME ),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget'  => '</aside>',
		]
	);

	register_sidebar(
		[
			'name'          => __( 'Breadcrumb', THEME_NAME ),
			'id'            => 'breadcrumb-1',
			'description'   => __( 'The breadcrumb in a BLR theme', THEME_NAME ),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget'  => '</aside>',
		]
	);

	register_sidebar(
		[
			'name'          => __( 'Pre-Header', THEME_NAME ),
			'id'            => 'preheader-1',
			'description'   => __( 'The space above the header in a BLR theme', THEME_NAME ),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget'  => '</aside>',
		]
	);

	register_sidebar(
		[
			'name'          => __( 'Post-Footer', THEME_NAME ),
			'id'            => 'postfooter-1',
			'description'   => __( 'The area after the footer in a BLR theme', THEME_NAME ),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget'  => '</aside>',
		]
	);

	unregister_sidebar( 'sidebar-primary' );
}

function blr_base_theme_add_sidebar_body_classes( $classes ) {
	if ( is_active_sidebar( 'nav-1' ) && is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'layout--three-column';
	} else if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'layout--right-column';
	} else if ( is_active_sidebar( 'nav-1' ) ) {
		$classes[] = 'layout-- left-column';
	}

	return $classes;
}


function blr_base_theme_register_menus() {
	register_nav_menu( 'footer-menu', __( 'Footer Menu', THEME_NAME ) );
	register_nav_menu( 'search-menu', __( 'Search Menu', THEME_NAME ) );
}

add_action( 'init', 'blr_base_theme_register_menus' );
add_action( 'widgets_init', 'blr_base_theme_register_sidebars' );
add_action( 'body_class', 'blr_base_theme_add_sidebar_body_classes' );
