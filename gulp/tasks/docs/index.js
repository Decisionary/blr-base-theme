'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs
 */

// Gulp
var gulp = __require('gulp');

// Tasks
var usage = __requireTask('docs/usage');
var sass = __requireTask('docs/sass');
var js = __requireTask('docs/js');
var php = __requireTask('docs/php');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'docs';

// Register the task.
gulp.task(task, gulp.parallel(usage.task, sass.task, js.task, php.task));