
// Gulp
const gulp = __require( 'gulp' );

// Tasks
const css    = __requireTask( 'build-css' );
const js     = __requireTask( 'build-js' );
const images = __requireTask( 'build-images' );
const fonts  = __requireTask( 'build-fonts' );

/**
 * Gulp callback for `build` task.
 *
 * @param {Function} done Async callback.
 */
export const callback = done => {

	css.callback();
	js.callback();
	images.callback();
	fonts.callback();

	done();
};

// Register the task.
gulp.task( 'build', callback );
