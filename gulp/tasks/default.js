
// Gulp
const gulp = __require( 'gulp' );

// Tasks
const build = __requireTask( 'build' );


/**
 * Gulp callback for 'default' task.
 *
 * @param  {Function} done Async callback.
 * @return {Function}
 */
export const callback = done => build.callback( done );


// Register the task.
gulp.task( 'default', callback );