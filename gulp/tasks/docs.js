
// Gulp
const gulp = __require( 'gulp' );

// Tasks
const sass = __requireTask( 'docs-sass' );

/**
 * Gulp callback for `docs` task.
 *
 * @param {Function} done Async callback.
 */
export const callback = async done => {

	await sass.callback();

	done();
};

// Register the task.
gulp.task( 'docs', callback );
