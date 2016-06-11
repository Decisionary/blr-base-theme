'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/build/fonts
 */

// Gulp
var gulp = __require('gulp');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build/fonts';

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
  source: ['../blr-base-theme/assets/source/fonts/*', 'assets/source/fonts/*', 'bower_components/font-awesome/fonts/fontawesome-webfont.*'],
  dest: 'assets/dist/fonts'
};

/**
 * Gulp callback for `build/fonts` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src(files.source).pipe(gulp.dest(files.dest));
};

// Register the task.
gulp.task(task, callback);