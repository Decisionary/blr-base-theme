/**
 * @module gulp/tasks/build-js
 */

// Gulp
import gulp       from 'gulp';

// Files
import rename     from 'gulp-rename';
import concat     from 'gulp-concat';
import sourcemaps from 'gulp-sourcemaps';

// JS
import babel      from 'gulp-babel';
import uglify     from 'gulp-uglify';

// Config
import files      from '../files/build-js';


/**
 * Compiles theme JS.
 *
 * @return {Function}
 */
const gulpBuildJS = () =>
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
gulp.task( 'build-js', gulpBuildJS );

export default gulpBuildJS;
