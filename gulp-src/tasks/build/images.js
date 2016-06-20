/**
 * @module gulp/tasks/build/images
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const _ = __require( 'lodash' );

// Files
const size = __require( 'gulp-size' );

// Images
const imagemin = __require( 'gulp-imagemin' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/images';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {
	size: {
		title: 'Images:',
	},
};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {

	source: [
		`${ __config.paths.assets.source }/images/*`,
	],

	dest: `${ __config.paths.assets.dist }/images`,

};

// Includes.
if ( ! _.isEmpty( __config.includes.images ) ) {
	files.source = _.concat(
		__config.includes.images,
		files.source
	);
}


/**
 * Gulp callback for `build/images` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( imagemin() )
		.pipe( size( config.size ) )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( task, callback );
