'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/default
 */

// Gulp
var gulp = __require('gulp');

// Tasks
__requireTask('build');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'default';

// Register the task.
gulp.task(task, gulp.series('build'));