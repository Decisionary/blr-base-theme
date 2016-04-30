
// Gulp
const gulp = __require( 'gulp' );

// SassDoc
const sassdoc = __require( 'sassdoc' );


// Task config.
export const config = {
	basePath: 'https://github.com/Decisionary/blr-base-theme/tree/master',
	dest:     'docs/sass',
	display:  {
		access: [ 'public' ],
	},
};


// Task files
export const files = {
	source: 'assets/source/css/**/*.scss',
};


/**
 * Gulp callback for `docs/sass` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( sassdoc( config ) );


// Register the task.
gulp.task( 'docs/sass', callback );
