'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs/sass
 */

// Gulp
var gulp = __require('gulp');

// SassDoc
var sassdoc = __require('sassdoc');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'docs/sass';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {
  basePath: 'https://github.com/Decisionary/blr-base-theme/tree/master',
  dest: 'docs/sass',
  display: {
    access: ['public']
  }
};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
  source: 'assets/source/css/**/*.scss'
};

/**
 * Gulp callback for `docs/sass` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src(files.source).pipe(sassdoc(config));
};

// Register the task.
gulp.task(task, callback);