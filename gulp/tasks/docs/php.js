'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs/php
 */

// Gulp
var gulp = __require('gulp');

// Utilities
var shell = __require('gulp-shell');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'docs/php';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {
  phpDoc: {
    quiet: true
  }
};

/**
 * Gulp callback for `docs/php` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.series(task);
};

// Register the task.
gulp.task(task, shell.task('phpdoc', config.phpDoc));