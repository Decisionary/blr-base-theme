'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs/js
 */

// Gulp
var gulp = __require('gulp');

// Utilities
var path = __require('path');
var shell = __require('gulp-shell');
var expect = __require('gulp-expect-file');

var currentDir = path.basename(process.cwd());
var isBaseTheme = 'blr-base-theme' === currentDir;

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
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
  source: ['assets/source/js/**/*.js']
};

if (!isBaseTheme) {
  files.source.unshift('../blr-base-theme/assets/source/js/**/*.js');
}

/**
 * Gulp callback for `docs/js` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src(files.source).pipe(expect(config.expect, '*.js')).pipe(shell('./node_modules/.bin/jsdoc -c jsdoc.conf.json', config.jsDoc));
};

// Register the task.
gulp.task(task, callback);