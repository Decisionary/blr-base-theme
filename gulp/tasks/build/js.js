'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
/**
 * @module gulp/tasks/build/js
 */

// Gulp
var gulp = __require('gulp');

// Utilities
var _ = __require('lodash');

// Files
var size = __require('gulp-size');
var merge = __require('merge-stream');
var rename = __require('gulp-rename');
var concat = __require('gulp-concat');
var sourcemaps = __require('gulp-sourcemaps');

// JS
var babel = __require('gulp-babel');
var uglify = __require('gulp-uglify');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build/js';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {

	size: {
		title: 'JS:'
	}

};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {

	watch: __config.paths.assets.source + '/js/**/*.js',

	dest: __config.paths.assets.dist + '/js',

	source: {
		admin: [__config.paths.assets.source + '/js/admin/**/*.js'],
		frontend: [__config.paths.assets.source + '/js/frontend/**/*.js']
	}

};

// Admin includes.
if (!_.isEmpty(__config.includes.js.admin)) {
	files.source.admin = _.concat(__config.includes.js.admin, files.source.admin);
}

// Frontend includes.
if (!_.isEmpty(__config.includes.js.frontend)) {
	files.source.frontend = _.concat(__config.includes.js.frontend, files.source.frontend);
}

/**
 * Compiles the CSS for a particular source.
 *
 * @param  {String|Array} source       A valid source path or array of paths.
 * @param  {String}       destFileName The filename to use for the compiled file.
 * @return {Stream}                    A Gulp stream.
 */
var compile = exports.compile = function compile(source, destFileName) {
	return gulp.src(source).pipe(sourcemaps.init()).pipe(concat(destFileName)).pipe(babel()).pipe(gulp.dest(files.dest)).pipe(uglify()).pipe(size(config.size)).pipe(rename({ suffix: '.min' })).pipe(sourcemaps.write('./maps')).pipe(gulp.dest(files.dest));
};

/**
 * Gulp callback for `build/js` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
	return merge(compile(files.source.frontend, 'app.js'), compile(files.source.admin, 'admin.js'));
};

// Register the task.
gulp.task(task, callback);