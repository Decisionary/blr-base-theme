'use strict';

require('babel-polyfill');

var path = require('path');
var gulpDir = process.env.gulpDir ? process.env.gulpDir : path.resolve('./gulp');

global.__require = function (pkg) {
	return require.main.require(pkg);
};
global.__requireTask = function (task) {
	return require.main.require(path.join(gulpDir, 'tasks', task));
};

var requireDir = require.main.require('require-dir');

module.exports = requireDir(gulpDir, {
	recurse: true,
	camelcase: true
});