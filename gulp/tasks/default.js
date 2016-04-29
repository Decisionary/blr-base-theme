/**
 * @module gulp/tasks/default
 */

// Gulp
import gulp  from 'gulp';

// Tasks
import build from './build';


/**
 * Gulp 'default' task.
 *
 * @param  {Function} done Async callback.
 * @return {Function}
 */
const gulpDefault = done => build( done );

// Register the task.
gulp.task( 'default', gulpDefault );

export default gulpDefault;
