'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs/usage
 */

// Gulp
var gulp = __require('gulp');

// Utilities
var fs = __require('fs-extra');
var path = __require('path');

// Style Sherpa
var sherpa = __require('style-sherpa');

var currentDir = path.basename(process.cwd());
var baseThemePath = 'blr-base-theme' === currentDir ? '.' : '../blr-base-theme';

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'docs/usage';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {
  sherpa: {
    output: 'docs/usage/index.html',
    template: baseThemePath + '/docs-src/usage/template.html'
  }
};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
  source: baseThemePath + '/docs-src/usage/index.md'
};

/**
 * Gulp callback for `docs/usage` task.
 *
 * @param {Function} done Async callback.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback(done) {

  fs.ensureDirSync(path.dirname(config.sherpa.output));

  return sherpa(files.source, config.sherpa, done);
};

// Register the task.
gulp.task(task, callback);