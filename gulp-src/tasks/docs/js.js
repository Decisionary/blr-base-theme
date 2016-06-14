/**
 * @module gulp/tasks/docs/js
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const path   = __require( 'path' );
const shell  = __require( 'gulp-shell' );
const expect = __require( 'gulp-expect-file' );

const currentDir  = path.basename( process.cwd() );
const isBaseTheme = ( 'blr-base-theme' === currentDir );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'docs/js';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	expect: {
		silent:           true,
		checkRealFile:    true,
		reportUnexpected: false,
	},
	jsDoc: {
		quiet: true,
	},
};

/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: [
		'assets/source/js/**/*.js',
	],
};

if ( ! isBaseTheme ) {
	files.source.unshift( '../blr-base-theme/assets/source/js/**/*.js' );
}


/**
 * Gulp callback for `docs/js` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( expect( config.expect, '*.js' ) )
		.pipe( shell( './node_modules/.bin/jsdoc -c jsdoc.conf.json', config.jsDoc ) );

// Register the task.
gulp.task( task, callback );
