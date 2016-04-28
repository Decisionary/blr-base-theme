
// Babel
import 'babel-polyfill';

// Gulp
import gulp         from 'gulp';

// Files
import rename       from 'gulp-rename';
import concat       from 'gulp-concat';
import sourcemaps   from 'gulp-sourcemaps';

// CSS / Sass
import sass         from 'gulp-sass';
import cssmin       from 'gulp-cssmin';
import autoprefixer from 'gulp-autoprefixer';

// JS
import babel        from 'gulp-babel';
import uglify       from 'gulp-uglify';

/**
 * Gulp tasks.
 */
class GulpTasks {

	/**
	 * Task configuration.
	 *
	 * @return {Object} The task configuration.
	 */
	get config() {
		return {
			sass: {
				outputStyle:  'expanded',
				precision:    10,
				includePaths: [
					'bower_components',
					'node_modules',
				],
			},
			autoprefixer: {
				browsers: [
					'last 2 versions',
					'android 4',
					'opera 12',
					'ie > 8',
					'> 1%',
				],
			},
		};
	}

	/**
	 * Files paths.
	 *
	 * @return {Object} File paths.
	 */
	get files() {
		return {
			css: {
				watch:  'assets/source/css/**/*.scss',
				source: [
					'assets/source/css/**/*.scss',
					'!assets/source/css/**/_*.scss',
				],
				dest: 'assets/dist/css/',
			},
			js: {
				watch:  'assets/source/js/**/*.js',
				source: 'assets/source/js/**/*.js',
				dest:   'assets/dist/js',
			},
		};
	}

	/**
	 * Tasks.
	 *
	 * @return {Array} Tasks.
	 */
	get tasks() {
		return [
			'build',
			'buildCSS',
			'buildJS',
			'watch',
			'default',
		];
	}

	/**
	 * Constructor.
	 *
	 * Once ES7 arrives we can just define class methods as arrow functions.
	 * In the meantime, we need to bind each task method to the class.
	 */
	constructor() {
		this.tasks.forEach( task => {
			this[ task ] = this[ task ].bind( this );
			gulp.task( task, this[ task ] );
		});
	}

	/**
	 * Build task.
	 *
	 * @param  {Function} done Async callback.
	 */
	async build( done ) {
		await this.buildCSS();
		await this.buildJS();
		done();
	}

	/**
	 * CSS build task.
	 *
	 * @return {Function}
	 */
	buildCSS() {
		return gulp.src( this.files.css.source )
			.pipe( sourcemaps.init() )
			.pipe( sass( this.config.sass ) )
			.pipe( concat( 'app.css' ) )
			.pipe( autoprefixer( this.config.autoprefixer ) )
			.pipe( gulp.dest( this.files.css.dest ) )
			.pipe( cssmin() )
			.pipe( rename({ suffix: '.min' }) )
			.pipe( sourcemaps.write( './maps' ) )
			.pipe( gulp.dest( this.files.css.dest ) );
	}

	/**
	 * JS build task.
	 *
	 * @return {Function}
	 */
	buildJS() {
		return gulp.src( this.files.js.source )
			.pipe( sourcemaps.init() )
			.pipe( babel() )
			.pipe( concat( 'app.js' ) )
			.pipe( gulp.dest( this.files.js.dest ) )
			.pipe( uglify() )
			.pipe( rename({ suffix: '.min' }) )
			.pipe( sourcemaps.write( './maps' ) )
			.pipe( gulp.dest( this.files.js.dest ) );
	}

	/**
	 * Watch task.
	 */
	watch() {
		gulp.watch( this.files.js.watch, this.buildJS );
		gulp.watch( this.files.css.watch, this.buildCSS );
	}

	/**
	 * Default task.
	 *
	 * @param  {Function} done Async callback.
	 */
	default( done ) {
		this.build( done );
	}
}

export default new GulpTasks();
