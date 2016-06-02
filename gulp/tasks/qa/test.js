'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/qa/test
 */

// Gulp
var gulp = __require('gulp');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'qa/test';

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {};

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {};

/**
 * Gulp callback for `qa/test` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return console.log('Unit test task - replace with actual code');
};

// Register the task.
gulp.task(task, callback);