<?php

namespace Roots\Sage\Wrapper;

/**
 * Theme wrapper.
 *
 * @link https://roots.io/sage/docs/theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
function template_path() {
	return SageWrapping::$main_template;
}

function sidebar_path() {
	return new SageWrapping( 'templates/sidebar.php' );
}

class SageWrapping {

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

	public function __construct( $template = 'base.php' ) {
		$this->slug = basename( $template, '.php' );
		$this->templates = [ $template ];

		if ( self::$base ) {
			$str = substr( $template, 0, -4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

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

		return new SageWrapping();
	}

	public function __toString() {
		$this->templates = apply_filters( 'sage/wrap_' . $this->slug, $this->templates );
		return locate_template( $this->templates );
	}
}

add_filter( 'template_include', [ __NAMESPACE__ . '\\SageWrapping', 'wrap' ], 109 );
