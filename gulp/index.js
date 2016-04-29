
require( 'babel-polyfill' );

const path    = require( 'path' );
const gulpDir = process.env.gulpDir || path.resolve( './gulp' );

global.__require     = pkg  => require.main.require( pkg );
global.__requireTask = task => require.main.require(
	path.join( gulpDir, 'tasks', task )
);

const requireDir = require.main.require( 'require-dir' );

module.exports = requireDir( gulpDir, {
	recurse:   true,
	camelcase: true,
} );
