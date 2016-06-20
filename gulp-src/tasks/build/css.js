/**
 * @module gulp/tasks/build/css
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const size       = __require( 'gulp-size' );
const merge      = __require( 'merge-stream' );
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// CSS / Sass
const sass    = __require( 'gulp-sass' );
const cssmin  = __require( 'gulp-cssmin' );
const postcss = __require( 'gulp-postcss' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/css';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {

	sass: {
		outputStyle:  'expanded',
		precision:    10,
		includePaths: __config.includes.sass,
	},

	postcss: {},

	autoprefixer: {
		browsers: __config.compat.browsers,
	},

	pxtorem: {
		replace:       false,
		mediaQuery:    false,
		minPixelValue: 4,
		unitPrecision: 10,
		propWhiteList: [],
	},

	selectorMatches: {
		lineBreak: true,
	},

	size: {
		title: 'Sass:',
	},

};

config.postcss.plugins = [

	// Automatically add vendor prefixes.
	__require( 'autoprefixer' )( config.autoprefixer ),

	// Enables the `initial` keyword.
	// Resets any property to its default value (e.g. `border: initial`).
	__require( 'postcss-initial' ),

	// Enables the `:matches()` pseudo-class.
	// Converts any selector that uses `:matches()` into separate selectors.
	// e.g. `a:matches( .b, .c ) { ... }` becomes `a.b, a.c { ... }`.
	__require( 'postcss-selector-matches' )( config.selectorMatches ),

	// Enables the `:enter` psuedo-class.
	// Targets `:focus` and `:hover`.
	__require( 'postcss-pseudo-class-enter' ),

	// Enables the `:any-link` pseudo-class.
	// Targets `:link` and `:visited`.
	__require( 'postcss-pseudo-class-any-link' ),

	// Enables the `:any-button` pseudo-class.
	// Targets `button` elements and `button`, `reset`, and `submit` inputs.
	__require( 'postcss-pseudo-class-any-button' ),

	// Combines media query blocks whenever possible.
	__require( 'css-mqpacker' ),

	// Converts `px` values in media queries to `em` values.
	__require( 'postcss-em-media-query' ),

	// Adds equivalent rem values for all pixel values. The original pixel
	// values are left intact as IE 8 doesn't support rems and IE 9 & 10 don't
	// support rems in the `font` shorthand property or in pseudo elements.
	__require( 'postcss-pxtorem' )( config.pxtorem ),

	// Adds `-js-display` rules where needed `for` the Flexibility polyfill.
	// Required for IE 8 and IE 9 support.
	__require( 'postcss-flexibility' ),

	// Automatically fixes many common flexbox issues.
	__require( 'postcss-flexbugs-fixes' ),
];


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {

	watch: `${ __config.paths.assets.source }/css/**/*.scss`,

	dest: `${ __config.paths.assets.dist }/css`,

	source: {
		admin: [
			`${ __config.paths.assets.source }/css/admin/**/*.scss`,
			`!${ __config.paths.assets.source }/css/admin/**/_*.scss`,
		],
		frontend: [
			`${ __config.paths.assets.source }/css/frontend/**/*.scss`,
			`!${ __config.paths.assets.source }/css/frontend/**/_*.scss`,
		],
	},

};


/**
 * Compiles the CSS for a particular source.
 *
 * @param  {String|Array} source       A valid source path or array of paths.
 * @param  {String}       destFileName The filename to use for the compiled file.
 * @param  {Boolean}      oldie        Optional. Set to true for IE 8 support.
 * @return {Stream}                    A Gulp stream.
 */
export const compile = ( source, destFileName, oldie = false ) => {

	const postcssPlugins = config.postcss.plugins;

	if ( oldie ) {

		// - Flattens media queries, replaces `:root` with `html`.
		// - Converts `rem` values to `px` values.
		// - Converts `opacity` rules to `filter` rules.
		// - Converts `::` pseudo-elements to the old `:` style.
		// - Converts `rgba` colors to `filter` gradients for background colors
		//   and hex colors everywhere else.
		// - Removes the `:not()` pseudo-class.
		// - Converts `:nth-child()` to `:first-child + * + ...`.
		postcssPlugins.push( __require( 'oldie' ) );
	}

	return gulp.src( source )
		.pipe( sourcemaps.init() )
		.pipe( sass( config.sass ) )
		.pipe( concat( destFileName ) )
		.pipe( postcss( postcssPlugins ) )
		.pipe( gulp.dest( files.dest ) )
		.pipe( cssmin() )
		.pipe( size( config.size ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );
};


/**
 * Gulp callback for `build/css` task.
 *
 * @return {Function}
 */
export const callback = () => merge(
	compile( files.source.frontend, 'app.css' ),
	compile( files.source.admin,    'admin.css' ),
	compile( files.source.frontend, 'app.oldie.css',   true ),
	compile( files.source.admin,    'admin.oldie.css', true )
);


// Register the task.
gulp.task( task, callback );
