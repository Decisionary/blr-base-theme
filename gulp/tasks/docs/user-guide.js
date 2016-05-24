/**
 * @module gulp/tasks/docs/usage
 */

// Gulp
const gulp = __require( 'gulp' );

// Sherpa
const sherpa = __require( 'style-sherpa' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'docs/usage';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	output:   'docs/usage/index.html',
	template: 'docs/_source/usage/template.html',
};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: 'docs/_source/usage/index.md',
};


/**
 * Gulp callback for `docs/usage` task.
 *
 * @param  {Function} done Async callback.
 * @return {Function}
 */
export const callback = done =>
	sherpa( files.source, config, done );


// Register the task.
gulp.task( task, callback );
