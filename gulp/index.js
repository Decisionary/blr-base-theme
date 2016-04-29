
const path       = require.main.require( 'path' );
const requireDir = require.main.require( 'require-dir' );

if ( ! process.env.gulpDir ) {
	process.env.gulpDir = path.resolve( './gulp' );
}

global.__require     = pkg  => require.main.require( pkg );
global.__requireTask = task => require.main.require(
	path.join( process.env.gulpDir, 'tasks', task )
);

module.exports = requireDir( process.env.gulpDir, {
	recurse:   true,
	camelcase: true,
} );
