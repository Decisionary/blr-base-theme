'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * @module gulp/tasks/watch
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
var task = exports.task = 'watch';

/**
 * Get the watch path(s) for a task.
 *
 * @param  {Object} taskModule The imported Gulp task module.
 * @return {String|Array|Bool} The path(s) if found, false if not.
 */
var getWatchFiles = exports.getWatchFiles = function getWatchFiles(taskModule) {

  if (taskModule.files.watch) {
    return taskModule.files.watch;
  }

  if (taskModule.files.source) {
    return taskModule.files.source;
  }

  return false;
};

/**
 * Registers a watch task for a particular set of files.
 *
 * @param {Object} taskModule The imported Gulp task module.
 */
var registerWatchTask = exports.registerWatchTask = function registerWatchTask(taskModule) {

  var watchFiles = getWatchFiles(taskModule);

  if (watchFiles) {
    gulp.watch(watchFiles, taskModule.task);
  }
};

/**
 * Gulp callback for `watch` task.
 */
var callback = exports.callback = function callback() {
  registerWatchTask(css);
  registerWatchTask(js);
  registerWatchTask(images);
  registerWatchTask(fonts);
};

// Register the task.
gulp.task(task, callback);