
/**
 * DOM-based Routing.
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 * Based on {@link http://goo.gl/EUTi53} by Paul Irish.
 *
 * @since 0.1.0
 */
( function( $ ) {

	/**
	 * Toggles an element attribute value.
	 *
	 * @since 0.5.1
	 *
	 * @param  {Number} index Element index.
	 * @param  {Bool}   val   Current attribute value.
	 * @return {Bool}         The updated attribute value.
	 */
	function toggleAttr( index, val ) {
		return 'true' !== val;
	}

	/**
	 * Define your routes and callbacks here.
	 *
	 * @since 0.1.0
	 *
	 * @type {Object}
	 */
	const routes = {

		// All pages.
		common: {

			init() {

				// Code goes here.
			},

			onReady() {

				// Initialize the placeholder polyfill if needed.
				if ( ( document.placeholderPolyfill || {} ).active ) {
					document.placeholderPolyfill();
				}

				// Make the primary nav collapsible if it exists.
				const $navPrimary = $( '.nav--primary' );

				if ( $navPrimary.length ) {
					$navPrimary.collapsibleNav();
				}

				// Make the sidebar nav collapsible if it exists.
				const $navSidebar = $( '.nav--sidebar' );

				if ( $navSidebar.length ) {
					$navSidebar.collapsibleNav();
				}

				// Collapsible section groups (e.g. accordions).
				const collapsibles = $( '.section-group.is-collapsible' );

				if ( collapsibles.length ) {
					const firstSection = collapsibles.find( '.section' ).first();

					if ( firstSection.hasClass( 'is-expanded' ) ) {
						firstSection.children( '.section__title' ).addClass( 'is-expanded' );
						firstSection.children( '.section__content' ).slideDown();
					}

					collapsibles.find( '.section__title' )
						.on( 'click', event => {
							event.preventDefault();

							const $this = $( event.currentTarget );

							$this.toggleClass( 'is-expanded' )
								.siblings( '.section__content' )
								.slideToggle()
								.attr( 'aria-expanded', toggleAttr );
						} );
				}
			},

		},

		// Home page
		home: {

			init() {

				// Code goes here.
			},

			onReady() {

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

	/**
	 * Triggers callbacks for the 'common' route on all pages, followed by any
	 * routes that match the current page.
	 *
	 * @since 0.1.0
	 *
	 * @type {Object}
	 */
	const router = {

		/**
		 * Triggers a route callback.
		 *
		 * @param  {String}   route  The name of the route to trigger.
		 * @param  {Function} [callback = 'init'] The callback to trigger.
		 * @param  {...*}     [args] Arguments to pass to the callback.
		 */
		route( route, callback = 'init', ...args ) {

			let trigger;

			trigger = ( '' !== route );
			trigger = ( trigger && routes[ route ] );
			trigger = ( trigger && 'function' === typeof routes[ route ][ callback ] );

			if ( trigger ) {
				routes[ route ][ callback ]( args );
			}

		},

		/**
		 * Loads routes for the current page and triggers any matching callbacks.
		 *
		 * @since 0.1.0
		 */
		loadRoutes() {

			// Fire init event for common route.
			router.route( 'common' );

			// Extract page-specific routes from body class.
			const pages = document.body.className
				.replace( /-/g, '_' )
				.split( /\s+/ );

			// Fire init and onReady events for page-specific routes.
			$.each( pages, ( i, className ) => {
				router.route( className );

				$( () => router.route( className, 'onReady' ) );
			} );

			// Fire onReady event for common route.
			$( () => router.route( 'common', 'onReady' ) );

		},

	};

	// Load Events on domReady.
	$( router.loadRoutes );

} )( window.jQuery );
