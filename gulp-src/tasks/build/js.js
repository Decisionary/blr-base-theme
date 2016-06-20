/**
 * @module gulp/tasks/build/js
 */

// Gulp
const gulp = __require( 'gulp' );

// Utilities
const _ = __require( 'lodash' );

// Files
const size       = __require( 'gulp-size' );
const merge      = __require( 'merge-stream' );
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// JS
const babel  = __require( 'gulp-babel' );
const uglify = __require( 'gulp-uglify' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/js';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {

	size: {
		title: 'JS:',
	},

};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {

	watch: `${ __config.paths.assets.source }/js/**/*.js`,

	dest: `${ __config.paths.assets.dist }/js`,

	source: {
		admin: [
			`${ __config.paths.assets.source }/js/admin/**/*.js`,
		],
		frontend: [
			`${ __config.paths.assets.source }/js/frontend/**/*.js`,
		],
		oldie: __config.includes.js.oldie,
	},

};

// Admin includes.
if ( ! _.isEmpty( __config.includes.js.admin ) ) {
	files.source.admin = _.concat(
		__config.includes.js.admin,
		files.source.admin
	);
}

// Frontend includes.
if ( ! _.isEmpty( __config.includes.js.frontend ) ) {
	files.source.frontend = _.concat(
		__config.includes.js.frontend,
		files.source.frontend
	);
}


/**
 * Compiles the CSS for a particular source.
 *
 * @param  {String|Array} source       A valid source path or array of paths.
 * @param  {String}       destFileName The filename to use for the compiled file.
 * @return {Stream}                    A Gulp stream.
 */
export const compile = ( source, destFileName ) =>
	gulp.src( source )
		.pipe( sourcemaps.init() )
		.pipe( concat( destFileName ) )
		.pipe( babel() )
		.pipe( gulp.dest( files.dest ) )
		.pipe( uglify() )
		.pipe( size( config.size ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );


/**
 * Gulp callback for `build/js` task.
 *
 * @return {Function}
 */
export const callback = () => merge(
	compile( files.source.frontend, 'app.js'   ),
	compile( files.source.admin,    'admin.js' ),
	compile( files.source.oldie,    'oldie.js' )
);


// Register the task.
gulp.task( task, callback );
