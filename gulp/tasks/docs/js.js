'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs/js
 */

// Gulp
var gulp = __require('gulp');

// SassDoc
var shell = __require('gulp-shell');
var expect = __require('gulp-expect-file');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'docs/js';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {
  expect: {
    silent: true,
    checkRealFile: true,
    reportUnexpected: false
  },
  jsDoc: {
    quiet: true
  }
};

/**
 * Gulp callback for `docs/js` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src('assets/src/**/*.js').pipe(expect(config.expect, '*.js')).pipe(shell('jsdoc -c jsdoc.conf.json', config.jsDoc));
};

// Register the task.
gulp.task(task, callback);