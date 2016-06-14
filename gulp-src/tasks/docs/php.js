/**
 * @module gulp/tasks/docs/php
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const shell = __require( 'gulp-shell' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'docs/php';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	phpDoc: {
		quiet: true,
	},
};


/**
 * Gulp callback for `docs/php` task.
 *
 * @return {Function}
 */
export const callback = () => gulp.series( task );


// Register the task.
gulp.task( task, shell.task( './vendor/bin/phpdoc', config.phpDoc ) );
