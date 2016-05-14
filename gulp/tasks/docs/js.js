/**
 * @module gulp/tasks/docs/js
 */

// Gulp
const gulp = __require( 'gulp' );

// SassDoc
const shell = __require( 'gulp-shell' );


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
	quiet: true,
};


/**
 * Gulp callback for `docs/js` task.
 *
 * @return {Function}
 */
export const callback = () => gulp.series( task );


// Register the task.
gulp.task( task, shell.task( 'jsdoc -c jsdoc.conf.json', config ) );
