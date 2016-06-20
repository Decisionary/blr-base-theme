'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/build/fonts
 */

// Gulp
var gulp = __require('gulp');

// Utilities
var _ = __require('lodash');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build/fonts';

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {

  source: [__config.paths.assets.source + '/fonts/*'],

  dest: __config.paths.assets.dist + '/fonts'

};

// Includes.
if (!_.isEmpty(__config.includes.fonts)) {
  files.source = _.concat(_.toArray(__config.includes.fonts), files.source);
}

/**
 * Gulp callback for `build/fonts` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
  return gulp.src(files.source).pipe(gulp.dest(files.dest));
};

// Register the task.
gulp.task(task, callback);