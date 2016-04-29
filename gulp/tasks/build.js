/**
 * @module gulp/tasks/build
 */

// Gulp
import gulp      from 'gulp';

// Sub-tasks
import buildCSS  from './build-css';
import buildJS   from './build-js';
import copyFonts from './copy-fonts';

/**
 * Build task.
 *
 * @param {Function} done Async callback.
 */
const gulpBuild = async done => {

	await buildCSS();
	await buildJS();
	await copyFonts();

	done();
};

// Register the task.
gulp.task( 'build', gulpBuild );

export default gulpBuild;
