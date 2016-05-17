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
 * @since 0.1.0
 *
 * @param \WP_Customize_Manager $wp_customizer The customizer instance.
 */
function setup( $wp_customizer ) {

	$logo_base = 'logo';
	if ( defined( 'WP_PROJECT_TYPE' ) ) {
		$logo_base .= '-' . strtolower( WP_PROJECT_TYPE );
	}

	$logo_button_labels = [
		'select'       => __( 'Select logo', 'blr-base-theme' ),
		'change'       => __( 'Change logo', 'blr-base-theme' ),
		'remove'       => __( 'Remove', 'blr-base-theme' ),
		'default'      => __( 'Default', 'blr-base-theme' ),
		'placeholder'  => __( 'No logo selected', 'blr-base-theme' ),
		'frame_title'  => __( 'Select logo', 'blr-base-theme' ),
		'frame_button' => __( 'Choose logo', 'blr-base-theme' ),
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
		'default' => apply_filters(
			'blr/logo-image-url',
			Assets\image_url( "{$logo_base}-primary.png" ),
			'primary'
		),
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
		'default' => apply_filters(
			'blr/logo-image-url',
			Assets\image_url( "{$logo_base}-search.png" ),
			'search'
		),
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
		'default' => apply_filters(
			'blr/logo-image-url',
			Assets\image_url( "{$logo_base}-footer.png" ),
			'footer'
		),
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


/**
 * Make the logo image URLs relative.
 *
 * @since 0.6.2
 *
 * @param  string $url  The current logo image URL.
 * @param  string $type The current logo type.
 * @return string       The updated logo image URL.
 */
function make_logo_url_relative( $url, $type ) {
	return wp_make_link_relative( $url );
}

add_filter( 'blr/logo-image-url', __NAMESPACE__ . '\\make_logo_url_relative', 10, 2 );
