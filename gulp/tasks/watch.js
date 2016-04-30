
// Gulp
const gulp = __require( 'gulp' );

// Tasks
const css = __requireTask( 'build-css' );
const js  = __requireTask( 'build-js' );


/**
 * Gulp callback for `watch` task.
 */
export const callback = () => {
	gulp.watch( css.files.watch, css.callback );
	gulp.watch( js.files.watch, js.callback );
};


// Register the task.
gulp.task( 'watch', callback );
