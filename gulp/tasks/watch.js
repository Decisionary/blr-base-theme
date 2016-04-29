/**
 * @module gulp/tasks/watch
 */

// Gulp
import gulp     from 'gulp';

// Tasks
import buildCSS from './build-css';
import buildJS  from './build-js';

// Files
import cssFiles from '../files/build-css';
import jsFiles  from '../files/build-js';


/**
 * Watch task.
 */
const gulpWatch = () => {
	gulp.watch( cssFiles.watch, buildCSS );
	gulp.watch( jsFiles.watch, buildJS );
};

// Register the task.
gulp.task( 'watch', gulpWatch );

export default gulpWatch;
