
// Gulp
const gulp = __require( 'gulp' );

// Tasks
const buildCSS = __requireTask( 'build-css' );
const buildJS  = __requireTask( 'build-js' );


/**
 * Gulp callback for `watch` task.
 */
export const callback = () => {
	gulp.watch( buildCSS.files.watch, buildCSS.callback );
	gulp.watch( buildJS.files.watch, buildJS.callback );
};


// Register the task.
gulp.task( 'watch', callback );
