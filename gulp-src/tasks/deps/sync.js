/**
 * @module gulp/tasks/deps/sync
 */

// Gulp
const gulp = __require( 'gulp' );

// Files
const fs = __require( 'fs-extra' );

// Utilities
const _  = __require( 'lodash' );
const cp = __require( 'child_process' );


/**
 * Task name.
 *
 * @type {String}
 */
export const task = 'deps/sync';


/**
 * Task config.
 *
 * @type {Object}
 */
export const config = {

	shell: {
		stdio: 'inherit',
	},

};


/**
 * Task files.
 *
 * @type {Object}
 */
export const files = {};


/**
 * Sort an object by its keys.
 *
 * @param  {Object} obj The object to sort.
 * @return {Object} The sorted object.
 */
export const sortObject = obj => {

	const sortedKeys = _.keys( obj ).sort();

	return sortedKeys.reduce( ( result, key ) => {

		if ( _.isPlainObject( obj[ key ] ) ) {
			obj[ key ] = sortObject( obj[ key ] );
		}

		result[ key ] = obj[ key ];

		return result;
	}, {} );
};

/**
 * Extract dependencies from npm / bower / composer JSON.
 *
 * @param  {Object} obj The JSON data.
 * @return {Object} The dependencies.
 */
export const getDeps = obj => {

	const deps = {
		dependencies:    obj.dependencies    || {},
		devDependencies: obj.devDependencies || {},
	};

	return _.omitBy( deps, _.isEmpty );
};


/**
 * Syncs dependencies between the base theme and the child theme.
 *
 * @param  {String} type ['npm'] Can be 'npm', 'bower', or 'composer'.
 */
export const syncDeps = ( type = 'npm' ) => {

	// Bail if dependency type is disabled or not supported.
	const enabled = __config.deps[ type ];
	const paths   = __config.paths.deps[ type ];

	if ( ! enabled || ! paths ) {
		return;
	}

	// Read data from npm / bower / composer JSON file.
	const baseData  = __require( paths.baseTheme );
	const childData = __require( paths.childTheme );

	// Extract dependencies.
	const baseDeps  = getDeps( baseData );
	const childDeps = getDeps( childData );

	// Bail if we don't have any dependencies to check.
	if ( _.isEmpty( baseDeps ) && _.isEmpty( childDeps ) ) {
		return;
	}

	// Combine base theme and child theme dependencies.
	// If there are version conflicts, the child theme version is used.
	const allDeps = getDeps( _.merge( {}, baseDeps, childDeps ) );

	// Bail if there's nothing new to sync / install.
	if ( _.isEqual( allDeps, childDeps ) ) {
		return;
	}

	// Update child theme npm / bower / composer JSON file.
	const jsonSpaces = 2;
	const childJSON  = JSON.stringify(
		_.merge( childData, sortObject( allDeps ) ),
		null,
		jsonSpaces
	);

	fs.writeFileSync( paths.childTheme, `${ childJSON }\n` );

	// Install the new package(s).
	cp.execSync( `${ type } install`, config.shell );
};


/**
 * Gulp callback for `deps/sync` task.
 *
 * @param  {Function} done Async callback.
 * @return {Function}
 */
export const callback = done => {

	syncDeps( 'npm' );
	syncDeps( 'bower' );
	syncDeps( 'composer' );

	return done();
};


// Register the task.
gulp.task( task, callback );
