<?php
/**
 * Asset functions.
 *
 * @package BLR_Base_Theme\Assets
 */

namespace BLR_Base_Theme\Assets;

/**
 * The path to the `assets` directory.
 *
 * @since 0.4.0
 *
 * @var string
 */
define( 'ASSETS_PATH', get_template_directory() . '/assets' );

/**
 * The URL to the `assets` directory.
 *
 * @since 0.1.0
 *
 * @var string
 */
define( 'ASSETS_URL', get_template_directory_uri() . '/assets' );

/**
 * Returns the path to an asset file.
 *
 * @since 0.4.0
 *
 * @param  string $rel_path Relative path to the file (e.g. 'js/main.js').
 * @return string
 */
function asset_path( $rel_path ) {
	return ASSETS_PATH . '/dist/' . $rel_path;
}

/**
 * Returns the URL to an asset file.
 *
 * @since 0.1.0
 *
 * @param  string $rel_path Relative path to the file (e.g. 'js/main.js').
 * @return string
 */
function asset_url( $rel_path ) {
	return ASSETS_URL . '/dist/' . $rel_path;
}
