
// Gulp
const gulp = __require( 'gulp' );

// Files
const size       = __require( 'gulp-size' );
const rename     = __require( 'gulp-rename' );
const concat     = __require( 'gulp-concat' );
const sourcemaps = __require( 'gulp-sourcemaps' );

// CSS / Sass
const sass         = __require( 'gulp-sass' );
const cssmin       = __require( 'gulp-cssmin' );
const autoprefixer = __require( 'gulp-autoprefixer' );


// Task config
export const config = {

	sass: {
		outputStyle:  'expanded',
		precision:    10,
		includePaths: [
			'../blr-base-theme/assets/source/css',
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


// Task files
export const files = {
	watch:  'assets/source/css/**/*.scss',
	source: [
		'assets/source/css/**/*.scss',
		'!assets/source/css/**/_*.scss',
	],
	dest: 'assets/dist/css/',
};


/**
 * Gulp callback for `build/css` task.
 *
 * @return {Function}
 */
export const callback = () =>
	gulp.src( files.source )
		.pipe( sourcemaps.init() )
		.pipe( sass( config.sass ) )
		.pipe( concat( 'app.css' ) )
		.pipe( autoprefixer( config.autoprefixer ) )
		.pipe( gulp.dest( files.dest ) )
		.pipe( cssmin() )
		.pipe( size( config.size ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './maps' ) )
		.pipe( gulp.dest( files.dest ) );


// Register the task.
gulp.task( 'build/css', callback );
