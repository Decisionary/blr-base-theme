<?php
/**
 * Asset functions.
 *
 * @package BLR\Base_Theme\Assets
 */

namespace BLR\Base_Theme\Assets;


/**
 * The assets directory name.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'ASSETS_DIR', 'assets' );

/**
 * The CSS directory name.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'CSS_DIR', 'css' );

/**
 * The JS directory name.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'JS_DIR', 'js' );

/**
 * The image directory name.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'IMAGE_DIR', 'images' );


/**
 * The path to the parent theme.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'PARENT_THEME_PATH', get_template_directory() );

/**
 * The path to the child theme.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'CHILD_THEME_PATH', get_stylesheet_directory() );

/**
 * The URL to the parent theme.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'PARENT_THEME_URL', get_template_directory_uri() );

/**
 * The URL to the child theme.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'CHILD_THEME_URL', get_stylesheet_directory_uri() );

/**
 * The path to the parent theme `assets` directory.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'PARENT_ASSETS_PATH', PARENT_THEME_PATH . '/assets' );

/**
 * The path to the child theme `assets` directory.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'CHILD_ASSETS_PATH', CHILD_THEME_PATH . '/assets' );

/**
 * The path to the `assets` directory.
 *
 * @since 0.4.0
 * @since 0.6.1 Now points to the child theme assets directory.
 *
 * @var string
 */
define( 'ASSETS_PATH', CHILD_ASSETS_PATH );

/**
 * The URL to the parent theme `assets` directory.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'PARENT_ASSETS_URL', PARENT_THEME_URL . '/assets' );

/**
 * The URL to the child theme `assets` directory.
 *
 * @since 0.6.1
 *
 * @var string
 */
define( 'CHILD_ASSETS_URL', CHILD_THEME_URL . '/assets' );

/**
 * The URL to the `assets` directory.
 *
 * @since 0.1.0
 * @since 0.6.1 Now points to the child theme assets directory.
 *
 * @var string
 */
define( 'ASSETS_URL', CHILD_ASSETS_URL );

/**
 * Returns the path to the assets directory.
 *
 * @since 0.6.1
 *
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function asset_dir_path( $location = 'child' ) {
	return ( 'parent' === $location ) ? PARENT_ASSETS_PATH : CHILD_ASSETS_PATH;
}

/**
 * Returns the URL to the assets directory.
 *
 * @since 0.6.1
 *
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function asset_dir_url( $location = 'child' ) {
	return ( 'parent' === $location ) ? PARENT_ASSETS_URL : CHILD_ASSETS_URL;
}

/**
 * Returns the path to an asset file.
 *
 * @since 0.4.0
 * @since 0.6.1 Added the `$location` parameter.
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function asset_path( $rel_path, $location = 'child' ) {
	return asset_dir_path( $location ) . '/dist/' . $rel_path;
}


/**
 * Returns the path to a CSS asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function css_path( $rel_path, $location = 'child' ) {
	return asset_path( CSS_DIR . '/' . $rel_path, $location );
}

/**
 * Returns the path to a JS asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function js_path( $rel_path, $location = 'child' ) {
	return asset_path( JS_DIR . '/' . $rel_path, $location );
}

/**
 * Returns the path to a CSS asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function image_path( $rel_path, $location = 'child' ) {
	return asset_path( IMAGE_DIR . '/' . $rel_path, $location );
}


/**
 * Returns the URL to an asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function asset_url( $rel_path, $location = 'child' ) {
	return asset_dir_url( $location ) . '/dist/' . $rel_path;
}

/**
 * Returns the URL to a CSS asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function css_url( $rel_path, $location = 'child' ) {
	return asset_url( CSS_DIR . '/' . $rel_path, $location );
}

/**
 * Returns the URL to a JS asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function js_url( $rel_path, $location = 'child' ) {
	return asset_url( JS_DIR . '/' . $rel_path, $location );
}

/**
 * Returns the URL to a CSS asset file.
 *
 * @since 0.1.0
 * @since 0.6.1 Added the `$location parameter.`
 *
 * @param  string $rel_path Relative path to the file.
 * @param  string $location Optional. The theme where the asset is located.
 *                          Can be 'child' or 'parent'. Defaults to 'child'.
 * @return string
 */
function image_url( $rel_path, $location = 'child' ) {
	return asset_url( IMAGE_DIR . '/' . $rel_path, $location );
}
