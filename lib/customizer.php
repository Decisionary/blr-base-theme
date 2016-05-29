<?php
/**
 * WordPress customizer setup.
 *
 * @package BLR\Base_Theme\Customizer
 */

namespace BLR\Base_Theme\Customizer;

use BLR\Base_Theme\Assets;

/**
 * Returns the default value for the specified Customizer setting.
 *
 * @since 0.7.0
 *
 * @param  string $setting The Customizer setting name.
 * @return mixed           The default value if one exists, null if not.
 */
function get_default( $setting ) {

	$logo_base = 'logo';

	if ( defined( 'WP_PROJECT_TYPE' ) ) {
		$logo_base .= '-' . strtolower( WP_PROJECT_TYPE );
	}

	$defaults = [
		'blr_base_theme_phone_number'   => '1-800-555-5555',
		'blr_base_theme_company_name'   => 'BLR&reg;&mdash;Business &amp; Legal Resources',
		'blr_base_theme_address_1'      => '100 Winners Circle, Suite 300',
		'blr_base_theme_address_2'      => 'Brentwood, TN 37027',
		'blr_base_theme_copyright_text' => 'Copyright &copy; ' . date( 'Y' ) . ' BLR&mdash;Business &amp; Legal Resources.  All rights reserved.',
		'blr_base_theme_logo_primary'   => Assets\image_url( "{$logo_base}-primary.png" ),
		'blr_base_theme_logo_search'    => Assets\image_url( "{$logo_base}-search.png" ),
		'blr_base_theme_logo_footer'    => Assets\image_url( "{$logo_base}-footer.png" ),
	];

	if ( isset( $defaults[ $setting ] ) ) {
		return $defaults[ $setting ];
	}

	return null;
}

/**
 * Sets up our custom sections, settings, and controls for WP Customizer.
 *
 * @since 0.1.0
 *
 * @param \WP_Customize_Manager $wp_customizer The customizer instance.
 */
function setup( $wp_customizer ) {

	$logo_button_labels = [
		'select'       => __( 'Select logo', 'blr-base-theme' ),
		'change'       => __( 'Change logo', 'blr-base-theme' ),
		'remove'       => __( 'Remove', 'blr-base-theme' ),
		'default'      => __( 'Default', 'blr-base-theme' ),
		'placeholder'  => __( 'No logo selected', 'blr-base-theme' ),
		'frame_title'  => __( 'Select logo', 'blr-base-theme' ),
		'frame_button' => __( 'Choose logo', 'blr-base-theme' ),
	];

	$wp_customizer->add_setting( 'blr_base_theme_phone_number', [
		'default' => get_default( 'blr_base_theme_phone_number' ),
	]);

	$wp_customizer->add_control( 'phone_number_textbox', [
		'label'    => __( 'Phone Number', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 10,
		'type'     => 'text',
		'settings' => 'blr_base_theme_phone_number',
	]);

	$wp_customizer->add_setting( 'blr_base_theme_company_name', [
		'default' => get_default( 'blr_base_theme_company_name' ),
	]);

	$wp_customizer->add_control( 'address_1_textbox', [
		'label'    => __( 'Address (Line 1)', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 10,
		'type'     => 'text',
		'settings' => 'blr_base_theme_address_1',
	]);

	$wp_customizer->add_setting( 'blr_base_theme_address_1', [
		'default' => get_default( 'blr_base_theme_address_1' ),
	]);

	$wp_customizer->add_control( 'address_1_textbox', [
		'label'    => __( 'Address (Line 1)', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 10,
		'type'     => 'text',
		'settings' => 'blr_base_theme_address_1',
	]);

	$wp_customizer->add_setting( 'blr_base_theme_address_2', [
		'default' => get_default( 'blr_base_theme_address_2' ),
	]);

	$wp_customizer->add_control( 'address_2_textbox', [
		'label'    => __( 'Address (Line 2)', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 10,
		'type'     => 'text',
		'settings' => 'blr_base_theme_address_2',
	]);

	$wp_customizer->add_setting( 'blr_base_theme_copyright_text', [
		'default' => get_default( 'blr_base_theme_copyright_text' ),
	]);

	$wp_customizer->add_control( 'copyright_textbox', [
		'label'    => __( 'Copyright Text', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 10,
		'type'     => 'text',
		'settings' => 'blr_base_theme_copyright_text',
	]);

	$wp_customizer->add_setting( 'blr_base_theme_logo_primary_enabled', [
		'default' => '1',
	]);

	$wp_customizer->add_control( 'blr_base_theme_logo_primary_enabled', [
		'type'     => 'checkbox',
		'label'    => __( 'Enable Header Logo', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 60,
	]);

	$wp_customizer->add_setting( 'blr_base_theme_logo_primary', [
		'default' => apply_filters(
			'blr/logo-image-url',
			get_default( 'blr_base_theme_logo_primary' ),
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

	$wp_customizer->add_setting( 'blr_base_theme_logo_search_enabled', [
		'default' => '1',
	]);

	$wp_customizer->add_control( 'blr_base_theme_logo_search_enabled', [
		'type'     => 'checkbox',
		'label'    => __( 'Enable Search Logo', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 60,
	]);

	$wp_customizer->add_setting( 'blr_base_theme_logo_search', [
		'default' => apply_filters(
			'blr/logo-image-url',
			get_default( 'blr_base_theme_logo_search' ),
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

	$wp_customizer->add_setting( 'blr_base_theme_logo_footer_enabled', [
		'default' => '1',
	]);

	$wp_customizer->add_control( 'blr_base_theme_logo_footer_enabled', [
		'type'     => 'checkbox',
		'label'    => __( 'Enable Footer Logo', 'blr-base-theme' ),
		'section'  => 'title_tagline',
		'priority' => 60,
	]);

	$wp_customizer->add_setting( 'blr_base_theme_logo_footer', [
		'default' => apply_filters(
			'blr/logo-image-url',
			get_default( 'blr_base_theme_logo_search' ),
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
