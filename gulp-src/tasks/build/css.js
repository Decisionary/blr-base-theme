/**
 * @module gulp/tasks/build/css
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const size       = __require( 'gulp-size' );
const merge      = __require( 'merge-stream' );
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// CSS / Sass
const sass         = __require( 'gulp-sass' );
const cssmin       = __require( 'gulp-cssmin' );
const autoprefixer = __require( 'gulp-autoprefixer' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'build/css';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {

	paths: {
		source: 'assets/source/css',
		dest:   'assets/dist/css',
	},

	sass: {
		outputStyle:  'expanded',
		precision:    10,
		includePaths: [
			'../blr-base-theme/assets/source/css',
			'../blr-base-theme/assets/source/css/frontend',
			'../blr-base-theme/assets/source/css/admin',
			'bower_components',
			'node_modules',
		],
	},

	autoprefixer: {
		browsers: [
			'last 2 versions',
			'android 4',
			'opera 12',
			'ie > 8',
			'> 1%',
		],
	},

	size: {
		title: 'Sass:',
	},

};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {
	watch:  `${ config.paths.source }/**/*.scss`,
	dest:   config.paths.dest,
	source: {
		admin: [
			`${ config.paths.source }/admin/**/*.scss`,
			`!${ config.paths.source }/admin/**/_*.scss`,
		],
		frontend: [
			`${ config.paths.source }/frontend/**/*.scss`,
			`!${ config.paths.source }/frontend/**/_*.scss`,
		],
	},
};


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
		.pipe( sass( config.sass ) )
		.pipe( concat( destFileName ) )
		.pipe( autoprefixer( config.autoprefixer ) )
		.pipe( gulp.dest( files.dest ) )
		.pipe( cssmin() )
		.pipe( size( config.size ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );


/**
 * Gulp callback for `build/css` task.
 *
 * @return {Function}
 */
export const callback = () => merge(
	compile( files.source.frontend, 'app.css'   ),
	compile( files.source.admin,    'admin.css' )
);


// Register the task.
gulp.task( task, callback );
