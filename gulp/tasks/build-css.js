/**
 * @module gulp/tasks/build-css
 */

// Gulp
import gulp         from 'gulp';

// Files
import rename       from 'gulp-rename';
import concat       from 'gulp-concat';
import sourcemaps   from 'gulp-sourcemaps';

// CSS / Sass
import sass         from 'gulp-sass';
import cssmin       from 'gulp-cssmin';
import autoprefixer from 'gulp-autoprefixer';

// Config
import config       from '../config/build-css';
import files        from '../files/build-css';


/**
 * Compiles theme Sass into CSS.
 *
 * @return {Function}
 */
const gulpBuildCSS = () =>
	gulp.src( files.source )
		.pipe( sourcemaps.init() )
		.pipe( sass( config.sass ) )
		.pipe( concat( 'app.css' ) )
		.pipe( autoprefixer( config.autoprefixer ) )
		.pipe( gulp.dest( files.dest ) )
		.pipe( cssmin() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );

// Register the task.
gulp.task( 'build-css', gulpBuildCSS );

export default gulpBuildCSS;
