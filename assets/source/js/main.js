
/**
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 */
( function( $ ) {

	// Use this variable to set up the common and page specific functions. If
	// you rename this variable, you'll also need to rename the namespace below.
	const routes = {

		// All pages.
		common: {

			init() {

				// Code goes here.
			},

			finalize() {

				// Code goes here.
			},

		},

		// Home page
		home: {

			init() {

				// Code goes here.
			},

			finalize() {

				// Code goes here.
			},

		},

		// About us page.
		about_us: {

			init() {

				// Code goes here.
			},

		},

	};

	// Fires all common scripts, followed by the page specific scripts.
	const router = {

		route( fn, fnName = 'init', ...args ) {

			let trigger;

			trigger = ( '' !== fn );
			trigger = ( trigger && routes[ fn ] );
			trigger = ( trigger && 'function' === typeof routes[ fn ][ fnName ] );

			if ( trigger ) {
				routes[ fn ][ fnName ]( args );
			}

		},

		loadRoutes() {

			// Fire common init JS.
			router.route( 'common' );

			// Fire page-specific init JS, and then finalize JS.
			const pages = document.body.className
				.replace( /-/g, '_' )
				.split( /\s+/ );

			$.each( pages, ( i, className ) => {
				router.route( className );
				router.route( className, 'finalize' );
			} );

			// Fire common finalize JS
			router.route( 'common', 'finalize' );

		},

	};

	// Load Events on domReady.
	$( router.loadRoutes );

} )( window.jQuery );
