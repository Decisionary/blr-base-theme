'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/qa
 */

// Gulp
var gulp = __require('gulp');

// Tasks
var lint = __requireTask('qa/lint');
var test = __requireTask('qa/test');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'qa';

// Register the task.
gulp.task(task, gulp.parallel(lint.task, test.task));