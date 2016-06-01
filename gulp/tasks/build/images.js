'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/build/images
 */

// Gulp
var gulp = __require('gulp');

// Files
var size = __require('gulp-size');

// Images
var imagemin = __require('gulp-imagemin');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build/images';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {
  size: {
    title: 'Images:'
  }
};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
  source: ['../blr-base-theme/assets/source/images/*', 'assets/source/images/*'],
  dest: 'assets/dist/images'
};

/**
 * Gulp callback for `build/images` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src(files.source).pipe(imagemin()).pipe(size(config.size)).pipe(gulp.dest(files.dest));
};

// Register the task.
gulp.task(task, callback);