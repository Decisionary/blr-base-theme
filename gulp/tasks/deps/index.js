'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/deps
 */

// Gulp
var gulp = __require('gulp');

// Tasks
var sync = __requireTask('deps/sync');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'deps';

// Register the task.
gulp.task(task, gulp.series(sync.task));