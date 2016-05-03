/**
 * @module gulp/tasks/watch
 */

// Gulp
const gulp = __require( 'gulp' );

// Tasks
const css    = __requireTask( 'build/css' );
const js     = __requireTask( 'build/js' );
const images = __requireTask( 'build/images' );
const fonts  = __requireTask( 'build/fonts' );


/**
 * Get the watch path(s) for a task.
 *
 * @param  {Object} task The imported Gulp task.
 * @return {Mixed}       The path (or an array of paths) if found, null if not.
 */
export const getWatchFiles = task => {

	if ( task.files.watch ) {
		return task.files.watch;
	}

	if ( task.files.source ) {
		return task.files.source;
	}

	return null;
};

/**
 * Registers a watch task for a particular set of files.
 *
 * @param  {Object} task The imported Gulp task module.
 */
export const registerWatchTask = task => {

	const watchFiles = getWatchFiles( task );

	if ( watchFiles ) {
		gulp.watch( watchFiles, task.callback );
	}
};


/**
 * Gulp callback for `watch` task.
 */
export const callback = () => {
	registerWatchTask( css );
	registerWatchTask( js );
	registerWatchTask( images );
	registerWatchTask( fonts );
};


// Register the task.
gulp.task( 'watch', callback );
