<?php
/**
 * WordPress customizer setup.
 *
 * @package BLR_Base_Theme\Customizer
 */

namespace BLR_Base_Theme\Customizer;

function blr_base_theme_customizer( $wp_customizer ) {

	$wp_customizer->add_section( 'blr_base_theme_header_logo', array(
		'title'       => __( 'Header Logo', THEME_NAME ),
		'priority'    => 30,
		'description' => 'Upload the primary logo for the header',
	));

	$wp_customizer->add_setting( 'blr_base_theme_primary_logo', array(
		'default' => get_bloginfo( 'template_directory' ) . '/images/primary-logo.png',
	));

	$wp_customizer->add_control(
		new WP_Customize_Image_Control(
			$wp_customizer,
			'blr_base_theme_primary_logo',
			array(
				'label'    => __( 'Primary Logo', THEME_NAME ),
				'section'  => 'blr_base_theme_header_logo',
				'settings' => 'blr_base_theme_primary_logo',
			)
		)
	);

	$wp_customizer->add_section( 'blr_base_theme_search_logo', array(
		'title'       => __( 'Search Logo', THEME_NAME ),
		'priority'    => 30,
		'description' => 'Upload the search logo for the header',
	));

	$wp_customizer->add_setting( 'blr_base_theme_search_logo', array(
		'default' => get_bloginfo( 'template_directory' ) . '/images/search-logo.png',
	));

	$wp_customizer->add_control(
		new WP_Customize_Image_Control(
			$wp_customizer,
			'blr_base_theme_search_logo',
			array(
				'label'    => __( 'Search Logo', THEME_NAME ),
				'section'  => 'blr_base_theme_search_logo',
				'settings' => 'blr_base_theme_search_logo',
			)
		)
	);

	$wp_customizer->add_section( 'blr_base_theme_footer_logo', array(
		'title'       => __( 'Footer Logo', THEME_NAME ),
		'priority'    => 30,
		'description' => 'Upload the footer logo for the header',
	));

	$wp_customizer->add_setting( 'blr_base_theme_footer_logo', array(
		'default' => get_bloginfo( 'template_directory' ) . '/images/footer-logo.png',
	));

	$wp_customizer->add_control(
		new WP_Customize_Image_Control(
			$wp_customizer,
			'blr_base_theme_footer_logo',
			array(
				'label'    => __( 'Footer Logo', THEME_NAME ),
				'section'  => 'blr_base_theme_footer_logo',
				'settings' => 'blr_base_theme_footer_logo',
			)
		)
	);

	$wp_customizer->add_section( 'blr_base_theme_copyright', array(
		'title'       => __( 'Footer Copyright Statement', THEME_NAME ),
		'priority'    => 30,
		'description' => 'Set the copyright text for the footer',
	));

	$wp_customizer->add_setting( 'blr_base_theme_copyright_text', array(
		'default' => 'Copyright &copy; ' . date( 'Y' ) . '&mdash; Business &amp Legal Resources.  All rights reserved.',
	));

	$wp_customizer->add_control(
		'copyright_textbox',
		array(
			'label'    => __( 'Copyright text', THEME_NAME ),
			'section'  => 'blr_base_theme_copyright',
			'type'     => 'text',
			'settings' => 'blr_base_theme_copyright_text',
		)
	);
}

add_action( 'customize_register', __NAMESPACE__ . '\\blr_base_theme_customizer' );
