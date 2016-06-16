/**
 * @module gulp/tasks/watch
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const _ = __require( 'lodash' );

// Tasks
const css    = __requireTask( 'build/css' );
const js     = __requireTask( 'build/js' );
const images = __requireTask( 'build/images' );
const fonts  = __requireTask( 'build/fonts' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'watch';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	watch: {
		atomic:           500,
		interval:         500,
		usePolling:       true,
		useFsEvents:      false,
		ignoreInitial:    true,
		followSymlinks:   false,
		awaitWriteFinish: true,
	},
};


/**
 * Get the watch path(s) for a task.
 *
 * @param  {Object} taskModule The imported Gulp task module.
 * @return {String|Array|Bool} The path(s) if found, false if not.
 */
export const getWatchFiles = taskModule => {

	if ( ! _.isEmpty( taskModule.files.watch ) ) {
		return taskModule.files.watch;
	}

	if ( ! _.isEmpty( taskModule.files.source ) ) {
		return taskModule.files.source;
	}

	return false;
};


/**
 * Registers a watch task for a particular set of files.
 *
 * @param {Object} taskModule The imported Gulp task module.
 */
export const registerWatchTask = taskModule => {

	const watchFiles = getWatchFiles( taskModule );

	if ( watchFiles ) {
		gulp.watch( watchFiles, config.watch, gulp.series( taskModule.task ) );
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
gulp.task( task, callback );
