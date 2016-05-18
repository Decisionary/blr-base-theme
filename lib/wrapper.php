<?php
/**
 * Theme wrapper functionality.
 *
 * @package BLR\Base_Theme\Wrapper
 */

namespace BLR\Base_Theme\Wrapper;


/**
 * Returns the main template file path.
 *
 * @since 0.1.0
 * @since 0.6.0 Re-named function to `main_template_path()`.
 *
 * @return string
 */
function main_template_path() {
	return ThemeWrapper::$main_template;
}

/**
 * Wraps a template file and returns its path.
 *
 * @since 0.6.0
 *
 * @param  string $template The template file (without the extension).
 * @return string
 */
function template_path( $template ) {
	return new ThemeWrapper( "templates/{$template}.php" );
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

		$this->slug      = basename( $template, '.php' );
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

		$this->templates = apply_filters(
			'blr-base-theme/wrap_' . $this->slug,
			$this->templates
		);

		$this->templates = apply_filters(
			'blr/template/wrap',
			$this->templates,
			$this->slug
		);

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
