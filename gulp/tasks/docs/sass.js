'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/docs/sass
 */

// Gulp
var gulp = __require('gulp');

// Utilities
var path = __require('path');

// SassDoc
var sassdoc = __require('sassdoc');

var currentDir = path.basename(process.cwd());
var isBaseTheme = 'blr-base-theme' === currentDir;

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'docs/sass';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {
  basePath: 'https://github.com/Decisionary/blr-base-theme/tree/master',
  dest: 'docs/sass',
  display: {
    access: ['public']
  }
};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
  source: ['assets/source/css/**/*.scss']
};

if (!isBaseTheme) {
  files.source.unshift('../blr-base-theme/assets/source/css/**/*.scss');
}

/**
 * Gulp callback for `docs/sass` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src(files.source).pipe(sassdoc(config));
};

// Register the task.
gulp.task(task, callback);