<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 *
 * @package BLR_Base_Theme/Includes
 */
define('THEME_NAME','blr-base-theme');
$sage_includes = [
	'lib/assets.php',     // Scripts and stylesheets.
	'lib/extras.php',     // Custom functions.
	'lib/setup.php',      // Theme setup.
	'lib/titles.php',     // Page titles.
	'lib/wrapper.php',    // Theme wrapper class.
	'lib/customizer.php', // Theme customizer.
];

foreach ( $sage_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		$error_message = sprintf( __( 'Error locating %s for inclusion', 'sage' ), $file );
		trigger_error( esc_html( $error_message ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );


function blr_base_theme_register_sidebars() {
	register_sidebar(
		[
			'name' => __('Left Nav', THEME_NAME),
			'id' => 'nav-1',
			'description' => __('The left navigation sidebar in a BLR theme',THEME_NAME),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget' => '</aside>'
		]
	);

	register_sidebar(
		[
			'name' => __('Right Sidebar', THEME_NAME),
			'id' => 'sidebar-1',
			'description' => __('The right sidebar sidebar in a BLR theme',THEME_NAME),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget' => '</aside>'
		]
	);

	register_sidebar(
		[
			'name' => __('Breadcrumb', THEME_NAME),
			'id' => 'breadcrumb-1',
			'description' => __('The breadcrumb in a BLR theme',THEME_NAME),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget' => '</aside>'
		]
	);

	unregister_sidebar('sidebar-primary');
}

function blr_base_theme_add_sidebar_body_classes($classes){
	if(is_active_sidebar('nav-1')) {
		$classes[] = 'left-nav-active';
	}

	if(is_active_sidebar('sidebar-1')) {
		$classes[] = 'right-sidebar-active';
	}

	return $classes;
}

add_action( 'widgets_init', 'blr_base_theme_register_sidebars' );
add_action('body_class','blr_base_theme_add_sidebar_body_classes');
