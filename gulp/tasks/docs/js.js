/**
 * @module gulp/tasks/docs/js
 */

// Gulp
const gulp = __require( 'gulp' );

// SassDoc
const shell  = __require( 'gulp-shell' );
const expect = __require( 'gulp-expect-file' );


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
 * Gulp callback for `docs/js` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( 'assets/src/**/*.js' )
		.pipe( expect.real( config.expect, '*.js' ) )
		.pipe( shell( 'jsdoc -c jsdoc.conf.json', config.jsDoc ) );

// Register the task.
gulp.task( task, callback );
