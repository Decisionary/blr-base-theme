'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
/**
 * @module gulp/tasks/build/css
 */

// Gulp
var gulp = __require('gulp');

// Files
var size = __require('gulp-size');
var rename = __require('gulp-rename');
var concat = __require('gulp-concat');
var sourcemaps = __require('gulp-sourcemaps');

// CSS / Sass
var sass = __require('gulp-sass');
var cssmin = __require('gulp-cssmin');
var autoprefixer = __require('gulp-autoprefixer');

/**
 * Task name.
 *
 * @type {String}
 */
var task = exports.task = 'build/css';

/**
 * Task config.
 *
 * @type {Object}
 */
var config = exports.config = {

	sass: {
		outputStyle: 'expanded',
		precision: 10,
		includePaths: ['../blr-base-theme/assets/source/css', 'bower_components', 'node_modules']
	},

	autoprefixer: {
		browsers: ['last 2 versions', 'android 4', 'opera 12', 'ie > 8', '> 1%']
	},

	size: {
		title: 'Sass:'
	}

};

/**
 * Task files.
 *
 * @type {Object}
 */
var files = exports.files = {
	watch: 'assets/source/css/**/*.scss',
	source: ['assets/source/css/**/*.scss', '!assets/source/css/**/_*.scss'],
	dest: 'assets/dist/css/'
};

/**
 * Gulp callback for `build/css` task.
 *
 * @return {Function}
 */
var callback = exports.callback = function callback() {
	return gulp.src(files.source).pipe(sourcemaps.init()).pipe(sass(config.sass)).pipe(concat('app.css')).pipe(autoprefixer(config.autoprefixer)).pipe(gulp.dest(files.dest)).pipe(cssmin()).pipe(size(config.size)).pipe(rename({ suffix: '.min' })).pipe(sourcemaps.write('./maps')).pipe(gulp.dest(files.dest));
};

// Register the task.
gulp.task(task, callback);