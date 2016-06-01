'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/qa/travis
 */

// Gulp
var gulp = __require('gulp');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'qa/travis';

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
 * Gulp callback for `qa/travis` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return console.log('Travis-CI task - replace with actual code');
};

// Register the task.
gulp.task(task, callback);