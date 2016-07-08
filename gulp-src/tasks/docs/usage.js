/**
 * @module gulp/tasks/docs/usage
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const fs   = __require( 'fs-extra' );
const path = __require( 'path' );

// Style Sherpa
const sherpa = __require( 'style-sherpa' );


const currentDir    = path.basename( process.cwd() );
const baseThemePath = ( 'blr-base-theme' === currentDir ) ? '.' : '../blr-base-theme';


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
	sherpa: {
		output:   'docs/usage/index.html',
		template: `${ baseThemePath }/docs-src/usage/template.html`,
	},
};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: `${ baseThemePath }/docs-src/usage/index.md`,
};


/**
 * Gulp callback for `docs/usage` task.
 *
 * @param {Function} done Async callback.
 *
 * @return {Function}
 */
export const callback = done => {

	fs.ensureDirSync( path.dirname( config.sherpa.output ) );

	return sherpa( files.source, config.sherpa, done );
};


// Register the task.
gulp.task( task, callback );
