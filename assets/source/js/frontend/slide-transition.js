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

	$.fn.collapsible = function( options ) {
		return this.each( ( index, element ) => {
			const $el      = $( element );
			const $title   = $el.find( options.titleSelector );
			const $content = $el.find( options.contentSelector );

			$title.on( 'click', event => {
				event.preventDefault();

				$content.slideToggle();
			} );
		} );
	};

	/**
	 * Sets up click handlers for a toggle button and associated collapsible
	 * elements - nav menu items, accordion items, etc.
	 *
	 * @since 0.5.1
	 *
	 * @param  {Object} options Plugin options.
	 * @return {Object}
	 */
	$.fn.slideToggleButton = function( options ) {
		return this.each( ( index, element ) => {
			const $button    = $( element );
			const $container = $( options.container );
			const $items     = $( options.items );

			$button.on( 'click', event => {
				event.preventDefault();

				$container.slideToggle();
				$button.toggleClass( 'is-active' ).attr( 'aria-expanded', toggleAttr );
			} );

			if ( $items.length ) {
				$items.on( 'click', event => {
					const $subMenu = $( event.currentTarget ).siblings( '.sub-menu' );

					if ( $subMenu.length ) {
						event.preventDefault();

						let containerHeight = $container.outerHeight();

						if ( $subMenu.hasClass( 'is-expanded' ) ) {
							containerHeight -= $container.outerHeight();
						} else {
							$container.css( 'max-height', 'none' );
							containerHeight += $container.outerHeight();
							$container.css( 'max-height', '0' );
						}

						$container.css( 'max-height', containerHeight );

						$subMenu.slideToggle()
							.parent()
							.attr( 'aria-expanded', toggleAttr )
							.siblings()
							.removeClass( 'is-expanded' )
							.attr( 'aria-expanded', false )
							.find( '.menu' )
							.slideUp();
					}
				} );
			}
		} );
	};

	/**
	 * Slide up transition.
	 *
	 * @since 0.5.1
	 *
	 * @return {Object}
	 */
	$.fn.slideUp = function() {
		return this.each( ( index, element ) => {
			const $el = $( element );

			// Trigger the slide up transition.
			$el.css( 'max-height', '0' ).removeClass( 'is-expanded' );
		} );
	};

	/**
	 * Slide down transition.
	 *
	 * @since 0.5.1
	 *
	 * @return {Object}
	 */
	$.fn.slideDown = function() {
		return this.each( ( index, element ) => {
			const $el = $( element );

			// Temporarily make the element visible to get the size.
			$el.css( 'max-height', 'none' );
			const height = $el.outerHeight();

			console.log( height );

			// Hide the element again.
			$el.css( 'max-height', '0' );

			// Trigger the slide down transition.
			const timeout = 1;

			setTimeout( () => {
				$el.css( 'max-height', height ).addClass( 'is-expanded' );
			}, timeout );
		} );
	};

	/**
	 * Toggle slide transition.
	 *
	 * @since 0.5.1
	 *
	 * @return {Object}
	 */
	$.fn.slideToggle = function() {
		return this.each( ( index, element ) => {
			const $el = $( element );

			if ( $el.hasClass( 'is-expanded' ) ) {
				$el.slideUp();
			} else {
				$el.slideDown();
			}
		} );
	};
} )( window.jQuery );
