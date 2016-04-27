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

namespace BLR_Base_Theme;

$includes = [
	'lib/assets.php',     // Scripts and stylesheets.
	'lib/extras.php',     // Custom functions.
	'lib/nav-mods.php',   // Nav menu mods.
	'lib/setup.php',      // Theme setup.
	'lib/titles.php',     // Page titles.
	'lib/wrapper.php',    // Theme wrapper class.
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
