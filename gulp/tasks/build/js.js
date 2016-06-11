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

	paths: {
		source: 'assets/source/js',
		dest: 'assets/dist/js'
	},

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
	watch: config.paths.source + '/**/*.js',
	dest: config.paths.dest,
	libs: {
		admin: [],
		frontend: []
	},
	source: {
		admin: ['../blr-base-theme/assets/source/js/admin/**/*.js', config.paths.source + '/admin/**/*.js'],
		frontend: ['../blr-base-theme/assets/source/js/frontend/**/*.js', config.paths.source + '/frontend/**/*.js']
	}
};

var taskConfig = (global.gulpConfig || {}).js || {};

if (taskConfig.libs) {
	if (taskConfig.libs.admin) {
		files.source.admin = _.concat(_.toArray(taskConfig.libs.admin), files.source.admin);
	}

	if (taskConfig.libs.frontend) {
		files.source.frontend = _.concat(_.toArray(taskConfig.libs.frontend), files.source.frontend);
	}
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