'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
/**
 * @module gulp/tasks/deps/sync
 */

// Gulp
var gulp = __require('gulp');

// Files
var fs = __require('fs-extra');

// Utilities
var _ = __require('lodash');
var cp = __require('child_process');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'deps/sync';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {

	shell: {
		stdio: 'inherit'
	}

};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {};

/**
 * Sort an object by its keys.
 *
 * @param  {Object} obj The object to sort.
 * @return {Object} The sorted object.
 */
var sortObject = exports.sortObject = function sortObject(obj) {

	var sortedKeys = _.keys(obj).sort();

	return sortedKeys.reduce(function (result, key) {

		if (_.isPlainObject(obj[key])) {
			obj[key] = sortObject(obj[key]);
		}

		result[key] = obj[key];

		return result;
	}, {});
};

/**
 * Extract dependencies from npm / bower / composer JSON.
 *
 * @param  {Object} obj The JSON data.
 * @return {Object} The dependencies.
 */
var getDeps = exports.getDeps = function getDeps(obj) {

	var deps = {
		dependencies: obj.dependencies || {},
		devDependencies: obj.devDependencies || {}
	};

	return _.omitBy(deps, _.isEmpty);
};

/**
 * Syncs dependencies between the base theme and the child theme.
 *
 * @param  {String} type ['npm'] Can be 'npm', 'bower', or 'composer'.
 */
var syncDeps = exports.syncDeps = function syncDeps() {
	var type = arguments.length <= 0 || arguments[0] === undefined ? 'npm' : arguments[0];


	// Bail if dependency type is disabled or not supported.
	var enabled = __config.deps[type];
	var paths = __config.paths.deps[type];

	if (!enabled || !paths) {
		return;
	}

	// Read data from npm / bower / composer JSON file.
	var baseData = __require(paths.baseTheme);
	var childData = __require(paths.childTheme);

	// Extract dependencies.
	var baseDeps = getDeps(baseData);
	var childDeps = getDeps(childData);

	// Bail if we don't have any dependencies to check.
	if (_.isEmpty(baseDeps) && _.isEmpty(childDeps)) {
		return;
	}

	// Combine base theme and child theme dependencies.
	// If there are version conflicts, the child theme version is used.
	var allDeps = getDeps(_.merge({}, baseDeps, childDeps));

	// Bail if there's nothing new to sync / install.
	if (_.isEqual(allDeps, childDeps)) {
		return;
	}

	// Update child theme npm / bower / composer JSON file.
	var jsonSpaces = 2;
	var childJSON = JSON.stringify(_.merge(childData, sortObject(allDeps)), null, jsonSpaces);

	fs.writeFileSync(paths.childTheme, childJSON + '\n');

	// Install the new package(s).
	cp.execSync(type + ' install', config.shell);
};

/**
 * Gulp callback for `deps/sync` task.
 *
 * @param  {Function} done Async callback.
 * @return {Function}
 */
var callback = exports.callback = function callback(done) {

	syncDeps('npm');
	syncDeps('bower');
	syncDeps('composer');

	return done();
};

// Register the task.
gulp.task(task, callback);