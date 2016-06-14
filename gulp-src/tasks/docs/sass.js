/**
 * @module gulp/tasks/docs/sass
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const path = __require( 'path' );

// SassDoc
const sassdoc = __require( 'sassdoc' );

const currentDir  = path.basename( process.cwd() );
const isBaseTheme = ( 'blr-base-theme' === currentDir );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'docs/sass';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	basePath: 'https://github.com/Decisionary/blr-base-theme/tree/master',
	dest:     'docs/sass',
	display:  {
		access: [ 'public' ],
	},
};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	source: [
		'assets/source/css/**/*.scss',
	],
};

if ( ! isBaseTheme ) {
	files.source.unshift( '../blr-base-theme/assets/source/css/**/*.scss' );
}


/**
 * Gulp callback for `docs/sass` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( sassdoc( config ) );


// Register the task.
gulp.task( task, callback );
