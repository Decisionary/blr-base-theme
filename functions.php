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

	register_sidebar(
		[
			'name' => __('Pre-Header', THEME_NAME),
			'id' => 'preheader-1',
			'description' => __('The space above the header in a BLR theme',THEME_NAME),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget' => '</aside>'
		]
	);

	register_sidebar(
		[
			'name' => __('Post-Footer', THEME_NAME),
			'id' => 'postfooter-1',
			'description' => __('The area after the footer in a BLR theme',THEME_NAME),
			'before_widget' => '<aside id="%1$s" class="widget-%2$s">',
			'after_widget' => '</aside>'
		]
	);

	unregister_sidebar('sidebar-primary');
}

function blr_base_theme_add_sidebar_body_classes($classes){
	if(is_active_sidebar('nav-1') && is_active_sidebar('sidebar-1')) {
		$classes[] = 'three-column';
	}else if(is_active_sidebar('sidebar-1')) {
		$classes[] = 'right-column';
	} else if (is_active_sidebar('nav-1')) {
		$classes[] = 'left-column';
	}

	return $classes;
}

function blr_base_theme_customizer( $wp_customizer ) {
	$wp_customizer->add_section( 'blr_base_theme_header_logo', array(
			'title' => __('Header Logo', THEME_NAME),
			'priority' => 30,
			'description' => "Upload the primary logo for the header"
		)
	);

	$wp_customizer->add_setting('blr_base_theme_primary_logo', array(
		'default' => get_bloginfo('template_directory') . '/images/primary-logo.png',
	));

	$wp_customizer->add_control( new WP_Customize_Image_Control($wp_customizer, 'blr_base_theme_primary_logo',array(
		'label' => __('Primary Logo', THEME_NAME),
		'section' => 'blr_base_theme_header_logo',
		'settings' => 'blr_base_theme_primary_logo'
	)));

	$wp_customizer->add_section( 'blr_base_theme_search_logo', array(
			'title' => __('Search Logo', THEME_NAME),
			'priority' => 30,
			'description' => "Upload the search logo for the header"
		)
	);

	$wp_customizer->add_setting('blr_base_theme_search_logo', array(
		'default' => get_bloginfo('template_directory') . '/images/search-logo.png',
	));

	$wp_customizer->add_control( new WP_Customize_Image_Control($wp_customizer, 'blr_base_theme_search_logo',array(
		'label' => __('Search Logo', THEME_NAME),
		'section' => 'blr_base_theme_search_logo',
		'settings' => 'blr_base_theme_search_logo'
	)));

	$wp_customizer->add_section( 'blr_base_theme_footer_logo', array(
			'title' => __('Footer Logo', THEME_NAME),
			'priority' => 30,
			'description' => "Upload the footer logo for the header"
		)
	);

	$wp_customizer->add_setting('blr_base_theme_footer_logo', array(
		'default' => get_bloginfo('template_directory') . '/images/footer-logo.png',
	));

	$wp_customizer->add_control( new WP_Customize_Image_Control($wp_customizer, 'blr_base_theme_footer_logo',array(
		'label' => __('Footer Logo', THEME_NAME),
		'section' => 'blr_base_theme_footer_logo',
		'settings' => 'blr_base_theme_footer_logo'
	)));
}

function blr_base_theme_register_menus() {
	register_nav_menu('footer-menu', __('Footer Menu', THEME_NAME ) );
	register_nav_menu('search-menu', __('Search Menu', THEME_NAME ) );
}

add_action( 'init', 'blr_base_theme_register_menus' );
add_action( 'widgets_init' , 'blr_base_theme_register_sidebars' );
add_action( 'body_class' , 'blr_base_theme_add_sidebar_body_classes' );
add_action( 'customize_register' , 'blr_base_theme_customizer' );
