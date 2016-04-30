
// Gulp
const gulp = __require( 'gulp' );

// Files
const size = __require( 'gulp-size' );

// Images
const imagemin = __require( 'gulp-imagemin' );


// Task config
export const config = {
	size: {
		title: 'Images:',
	},
};


// Task files.
export const files = {
	source: 'assets/source/images/**/*',
	dest:   'assets/dist/images',
};

/**
 * Gulp callback for `build/images` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( imagemin() )
		.pipe( gulp.dest( files.dest ) )
		.pipe( size( config.size ) );


// Register the task.
gulp.task( 'build/images', callback );
