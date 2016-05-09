<?php
/**
 * WordPress customizer setup.
 *
 * @package BLR\Base_Theme\Customizer
 */

namespace BLR\Base_Theme\Customizer;

use BLR\Base_Theme\Assets;

/**
 * Sets up our custom sections, settings, and controls for WP Customizer.
 *
 * @param \WP_Customize_Manager $wp_customizer The customizer instance.
 */
function setup( $wp_customizer ) {

	$logo_button_labels = [
		'select'       => __( 'Select logo' ),
		'change'       => __( 'Change logo' ),
		'remove'       => __( 'Remove' ),
		'default'      => __( 'Default' ),
		'placeholder'  => __( 'No logo selected' ),
		'frame_title'  => __( 'Select logo' ),
		'frame_button' => __( 'Choose logo' ),
	];

	$wp_customizer->add_setting( 'blr_base_theme_copyright_text', [
		'default' => 'Copyright &copy; ' . date( 'Y' ) . '&mdash; Business &amp Legal Resources.  All rights reserved.',
	]);

	$wp_customizer->add_control( 'copyright_textbox', [
		'label'    => __( 'Copyright text', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 10,
		'type'     => 'text',
		'settings' => 'blr_base_theme_copyright_text',
	]);

	$wp_customizer->add_setting( 'blr_base_theme_logo_primary', [
		'default' => Assets\asset_url( 'images/logo-primary.png' ),
	]);

	$wp_customizer->add_control(
		new \WP_Customize_Cropped_Image_Control(
			$wp_customizer,
			'blr_base_theme_logo_primary',
			[
				'label'         => __( 'Header Logo', 'blr-base-theme' ),
				'section'       => 'title_tagline',
				'priority'      => 60,
				'flex_height'   => true,
				'flex_width'    => true,
				'button_labels' => $logo_button_labels,
			]
		)
	);

	$wp_customizer->add_setting( 'blr_base_theme_logo_search', [
		'default' => Assets\asset_url( 'images/logo-search.png' ),
	]);

	$wp_customizer->add_control(
		new \WP_Customize_Cropped_Image_Control(
			$wp_customizer,
			'blr_base_theme_logo_search',
			[
				'label'         => __( 'Search Logo', 'blr-base-theme' ),
				'section'       => 'title_tagline',
				'priority'      => 60,
				'flex_height'   => true,
				'flex_width'    => true,
				'button_labels' => $logo_button_labels,
			]
		)
	);

	$wp_customizer->add_setting( 'blr_base_theme_logo_footer', [
		'default' => Assets\asset_url( 'images/logo-footer.png' ),
	]);

	$wp_customizer->add_control(
		new \WP_Customize_Cropped_Image_Control(
			$wp_customizer,
			'blr_base_theme_logo_footer',
			[
				'label'         => __( 'Footer Logo', 'blr-base-theme' ),
				'section'       => 'title_tagline',
				'priority'      => 60,
				'flex_height'   => true,
				'flex_width'    => true,
				'button_labels' => $logo_button_labels,
			]
		)
	);
}

add_action( 'customize_register', __NAMESPACE__ . '\\setup' );
