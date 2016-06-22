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
var autoprefixer = __require('gulp-autoprefixer');

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

	sass: {
		outputStyle: 'expanded',
		precision: 10,
		includePaths: __config.includes.sass
	},

	autoprefixer: {
		browsers: __config.compat.browsers
	},

	size: {
		title: 'Sass:'
	}

};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {

	watch: __config.paths.assets.source + '/css/**/*.scss',

	dest: __config.paths.assets.dist + '/css',

	source: {
		admin: [__config.paths.assets.source + '/css/admin/**/*.scss', '!' + __config.paths.assets.source + '/css/admin/**/_*.scss'],
		frontend: [__config.paths.assets.source + '/css/frontend/**/*.scss', '!' + __config.paths.assets.source + '/css/frontend/**/_*.scss']
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
	return gulp.src(source).pipe(sourcemaps.init()).pipe(sass(config.sass)).pipe(concat(destFileName)).pipe(autoprefixer(config.autoprefixer)).pipe(gulp.dest(files.dest)).pipe(cssmin()).pipe(size(config.size)).pipe(rename({ suffix: '.min' })).pipe(sourcemaps.write('./maps')).pipe(gulp.dest(files.dest));
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