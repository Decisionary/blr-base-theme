
// Gulp
const gulp       = __require( 'gulp' );

// Files
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// JS
const babel      = __require( 'gulp-babel' );
const uglify     = __require( 'gulp-uglify' );


// Task files.
export const files = {
	watch:  'assets/source/js/**/*.js',
	source: 'assets/source/js/**/*.js',
	dest:   'assets/dist/js',
};


/**
 * Gulp callback for `build-js` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( sourcemaps.init() )
		.pipe( babel() )
		.pipe( concat( 'app.js' ) )
		.pipe( gulp.dest( files.dest ) )
		.pipe( uglify() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( 'build-js', callback );
