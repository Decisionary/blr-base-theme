
const path    = require( 'path' );
const gulpDir = process.env.gulpDir
	? process.env.gulpDir
	: path.resolve( './gulp' );

global.__require     = pkg  => require.main.require( pkg );
global.__requireTask = task => require.main.require(
	path.join( gulpDir, 'tasks', task )
);

// Utilities
const _          = __require( 'lodash' );
const fs         = __require( 'fs-extra' );
const YAML       = __require( 'js-yaml' );
const requireDir = __require( 'require-dir' );

// See if we're running Gulp from the BLR Base Theme folder.
const currentDir    = path.basename( process.cwd() );
const isBaseTheme   = ( 'blr-base-theme' === currentDir );
const baseThemePath = path.resolve( ( isBaseTheme ) ? '.' : '../blr-base-theme' );

/**
 * Tries to load a YAML config file and parse it into JSON.
 *
 * @param  {String} filePath The path to the YAML file.
 * @return {Object|Boolean}  The parsed results. If the file is blank or
 *                           doesn't exist, we return false.
 */
const loadYAML = filePath => {

	try {

		// Get file contents as JSON.
		const yaml = fs.readFileSync( path.resolve( filePath ), 'utf8' );
		const json = YAML.safeLoad( yaml );

		// Make sure the config isn't empty.
		if ( json ) {
			return json;
		}
	} catch ( error ) {
		console.log( error );
	}

	// If the file doesn't exist or is empty, return false.
	return false;
};

/**
 * Loads, parses, and returns the Gulp config settings.
 *
 * Checks if a custom config file exists for the current child theme. If so,
 * the custom config is merged with the default config and returned. If no
 * custom config file exists, or if Gulp is being run from the base theme,
 * the default config is returned instead.
 *
 * @return {Object} The parsed config object.
 */
const loadConfig = () => {

	// Get the default config provided by the base theme.
	const defaults = loadYAML( path.join( baseThemePath, 'config.yml' ) );

	// Normalize some of the values.
	defaults.includes.js.admin    = _.toArray( defaults.includes.js.admin );
	defaults.includes.js.frontend = _.toArray( defaults.includes.js.frontend );

	// Return the default config if we're in the base theme folder.
	if ( isBaseTheme ) {
		return defaults;
	}

	// If not, see if the child theme has a custom config file.
	let config = loadYAML( 'config.yml' );

	// If no custom config is found, return the default config.
	if ( ! config ) {
		return defaults;
	}

	// Merge the custom and default configs and return the result.
	config = _.merge( config, defaults );

	// Base theme Sass includes.
	config.includes.sass.unshift(
		`${ baseThemePath }/assets/source/css`,
		`${ baseThemePath }/assets/source/css/frontend`,
		`${ baseThemePath }/assets/source/css/admin`,
		`${ baseThemePath }/bower_components`,
		`${ baseThemePath }/node_modules`
	);

	// Base theme JS includes.
	config.includes.js.frontend.push(
		`${ baseThemePath }/assets/source/js/frontend/**/*.js`
	);
	config.includes.js.admin.push(
		`${ baseThemePath }/assets/source/js/admin/**/*.js`
	);

	// Base theme images.
	config.includes.images.push( `${ baseThemePath }/assets/source/images/*` );

	// Base theme fonts.
	config.includes.fonts.push( `${ baseThemePath }/assets/source/fonts/*` );

	return config;
};

// Make config settings available globally;
global.__config = loadConfig();


// Export the base theme Gulp tasks.
module.exports = requireDir( gulpDir, {
	recurse:   true,
	camelcase: true,
} );
