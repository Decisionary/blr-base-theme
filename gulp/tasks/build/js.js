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
	libs: [],
	source: ['../blr-base-theme/assets/source/js/**/*.js', 'assets/source/js/**/*.js'],
	dest: 'assets/dist/js'
};

var taskConfig = (global.gulpConfig || {}).js || {};

if (taskConfig.libs) {
	files.source = _.concat(_.toArray(taskConfig.libs), files.source);
}

/**
 * Gulp callback for `build/js` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
	return gulp.src(files.source).pipe(sourcemaps.init()).pipe(concat('app.js')).pipe(babel()).pipe(gulp.dest(files.dest)).pipe(uglify()).pipe(size(config.size)).pipe(rename({ suffix: '.min' })).pipe(sourcemaps.write('./maps')).pipe(gulp.dest(files.dest));
};

// Register the task.
gulp.task(task, callback);