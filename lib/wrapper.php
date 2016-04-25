<?php
/**
 * Theme wrapper functionality.
 *
 * @package BLR_Base_Theme\Wrapper
 */

namespace BLR_Base_Theme\Wrapper;


/**
 * Returns the main template file path.
 *
 * @since 0.1.0
 *
 * @return string
 */
function template_path() {
	return ThemeWrapper::$main_template;
}

/**
 * Returns the sidebar template file path.
 *
 * @since 0.1.0
 *
 * @return string
 */
function sidebar_path() {
	return new ThemeWrapper( 'templates/sidebar.php' );
}

/**
 * Theme wrapper class.
 *
 * @since 0.1.0
 */
class ThemeWrapper {

	/**
	 * Stores the full path to the main template file.
	 *
	 * @var string
	 */
	public static $main_template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 *
	 * @var string
	 */
	public static $base;

	/**
	 * Basename of template file.
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Array of templates.
	 *
	 * @var array
	 */
	public $templates;

	/**
	 * Class constructor.
	 *
	 * @param string $template Optional. A template file to wrap.
	 */
	public function __construct( $template = 'base.php' ) {
		$this->slug = basename( $template, '.php' );
		$this->templates = [ $template ];

		if ( self::$base ) {
			$str = substr( $template, 0, -4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	/**
	 * Returns the wrapped template path when the class instance is converted
	 * or casted to a string.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function __toString() {
		$this->templates = apply_filters( 'blr-base-theme/wrap_' . $this->slug, $this->templates );
		return locate_template( $this->templates );
	}

	/**
	 * Wrap the main template file.
	 *
	 * @since 0.1.0
	 *
	 * @param  string $main The template file.
	 * @return ThemeWrapper
	 */
	public static function wrap( $main ) {

		// Check for other filters returning null.
		if ( ! is_string( $main ) ) {
			return $main;
		}

		self::$main_template = $main;
		self::$base = basename( self::$main_template, '.php' );

		if ( 'index' === self::$base ) {
			self::$base = false;
		}

		return new ThemeWrapper();
	}
}

add_filter( 'template_include', [ __NAMESPACE__ . '\\ThemeWrapper', 'wrap' ], 109 );
