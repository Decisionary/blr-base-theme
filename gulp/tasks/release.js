'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/release
 */

// Gulp
var gulp = __require('gulp');

// Tasks
var build = __requireTask('build');
var docs = __requireTask('docs');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'release';

// Register the task.
gulp.task(task, gulp.series(build.task, docs.task));