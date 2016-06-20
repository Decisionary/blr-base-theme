'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
/**
 * @module gulp/tasks/build/css
 */

// Gulp
var gulp = __require('gulp');

// Files
var size = __require('gulp-size');
var merge = __require('merge-stream');
var rename = __require('gulp-rename');
var concat = __require('gulp-concat');
var sourcemaps = __require('gulp-sourcemaps');

// CSS / Sass
var sass = __require('gulp-sass');
var cssmin = __require('gulp-cssmin');
var postcss = __require('gulp-postcss');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build/css';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {

	paths: {
		source: 'assets/source/css',
		dest: 'assets/dist/css'
	},

	sass: {
		outputStyle: 'expanded',
		precision: 10,
		includePaths: ['../blr-base-theme/assets/source/css', '../blr-base-theme/assets/source/css/frontend', '../blr-base-theme/assets/source/css/admin', 'bower_components', 'node_modules']
	},

	postcss: {},

	autoprefixer: {
		browsers: ['last 2 versions', 'android 4', 'opera 12', 'ie > 8', '> 1%']
	},

	pxtorem: {
		unitPrecision: 10,
		propWhiteList: []
	},

	size: {
		title: 'Sass:'
	}

};

config.postcss.plugins = [__require('autoprefixer')(config.autoprefixer), __require('postcss-pxtorem')(config.pxtorem), __require('css-mqpacker'), __require('postcss-flexibility'), __require('postcss-em-media-query'), __require('postcss-nested-ancestors'), __require('postcss-pseudo-class-any-button')];

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
	watch: config.paths.source + '/**/*.scss',
	dest: config.paths.dest,
	source: {
		admin: [config.paths.source + '/admin/**/*.scss', '!' + config.paths.source + '/admin/**/_*.scss'],
		frontend: [config.paths.source + '/frontend/**/*.scss', '!' + config.paths.source + '/frontend/**/_*.scss']
	}
};

/**
 * Compiles the CSS for a particular source.
 *
 * @param  {String|Array} source       A valid source path or array of paths.
 * @param  {String}       destFileName The filename to use for the compiled file.
 * @return {Stream}                    A Gulp stream.
 */
var compile = exports.compile = function compile(source, destFileName) {
	return gulp.src(source).pipe(sourcemaps.init()).pipe(sass(config.sass)).pipe(concat(destFileName)).pipe(postcss(config.postcss.plugins)).pipe(gulp.dest(files.dest)).pipe(cssmin()).pipe(size(config.size)).pipe(rename({ suffix: '.min' })).pipe(sourcemaps.write('./maps')).pipe(gulp.dest(files.dest));
};

/**
 * Gulp callback for `build/css` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
	return merge(compile(files.source.frontend, 'app.css'), compile(files.source.admin, 'admin.css'));
};

// Register the task.
gulp.task(task, callback);