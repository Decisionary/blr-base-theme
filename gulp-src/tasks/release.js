/**
 * @module gulp/tasks/release
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const fs   = __require( 'fs' );

// Process
const cp   = __require( 'child_process' );
const argv = __require( 'yargs' ).argv;

// Utilities
const semver = __require( 'semver' );

// Tasks
const build = __requireTask( 'build' );
const docs  = __requireTask( 'docs' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'release';


/**
 * Automatically bump the version number.
 *
 * @todo Update version number in `style.css`, `bower.json`, and `composer.json`.
 */
export const bump = () => {

	const increment  = 1;
	const errorCode  = 1;
	const jsonSpaces = 2;
	const pkg         = __require( './package.json' );
	const versionInfo = {
		major: semver.major( pkg.version ),
		minor: semver.minor( pkg.version ),
		patch: semver.patch( pkg.version ),
	};

	if ( '' !== cp.execSync( 'git status --porcelain' ).toString() ) {
		console.error( 'Working dirty. Please commit before trying again' );
		process.exit( errorCode );
	}

	if ( argv.major ) {
		versionInfo.major += increment;
		versionInfo.minor = 0;
		versionInfo.patch = 0;
	} else if ( argv.minor ) {
		versionInfo.minor += increment;
		versionInfo.patch = 0;
	} else if ( argv.patch ) {
		versionInfo.patch += increment;
	}

	const version = `${ versionInfo.major }.${ versionInfo.minor }.${ versionInfo.patch }`;

	pkg.version = version;

	const pkgJSON = JSON.stringify( pkg, null, jsonSpaces );

	fs.writeFileSync( './package.json', `${ pkgJSON }\n` );

	cp.execSync( `git commit -am "Release (${ version })"` );
	cp.execSync( `git tag ${ version }` );
};


// Register the task.
gulp.task( task, gulp.series( build.task, docs.task, bump ) );
