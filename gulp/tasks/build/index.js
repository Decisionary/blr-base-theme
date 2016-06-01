'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/build
 */

// Gulp
var gulp = __require('gulp');

// Tasks
var css = __requireTask('build/css');
var js = __requireTask('build/js');
var images = __requireTask('build/images');
var fonts = __requireTask('build/fonts');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build';

// Register the task.
gulp.task(task, gulp.series(css.task, js.task, images.task, fonts.task));