
// Gulp
const gulp = __require( 'gulp' );

// Tasks
const buildCSS  = __requireTask( 'build-css' );
const buildJS   = __requireTask( 'build-js' );
const copyFonts = __requireTask( 'copy-fonts' );

/**
 * Gulp callback for `build` task.
 *
 * @param {Function} done Async callback.
 */
export const callback = async done => {

	await buildCSS.callback();
	await buildJS.callback();
	await copyFonts.callback();

	done();
};

// Register the task.
gulp.task( 'build', callback );
