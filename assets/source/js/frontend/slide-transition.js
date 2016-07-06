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
	 * Sets up click handlers for a toggle button that hides / shows menu items
	 * for the current nav menu.
	 *
	 * @since 0.5.1
	 *
	 * @param  {Object} options       Plugin options.
	 * @param  {String} options.button A jQuery selector that targets the toggle button.
	 * @param  {String} options.menu   A jQuery selector that targets the menu container.
	 * @param  {String} options.items  A jQuery selector that targets the menu items.
	 * @return {Object}
	 */
	$.fn.collapsibleNav = function( options = {} ) {
		return this.each( ( index, element ) => {

			const defaults = {
				button: '.nav-toggle',
				menu:   '.menu',
				items:  '.menu__item',
			};

			options = $.extend( {}, defaults, options );

			console.log( options );

			const $nav    = $( element );
			const $button = $nav.find( options.button );
			const $menu   = $nav.find( options.menu );

			// Make sure we have a toggle button and a nav menu to toggle.
			if ( ! $button.length || ! $menu.length ) {
				return;
			}

			// Hide / show the nav menu when the toggle button is clicked.
			if ( $button.length ) {
				$button.on( 'click', event => {
					event.preventDefault();

					$nav.attr( 'aria-expanded', toggleAttr );
					$menu.slideToggle();
				} );
			}

			// Bail if we don't have a menu item selector.
			if ( ! options.items ) {
				return;
			}

			// Toggle sub-menus when the parent menu item is clicked.
			$menu.on( 'click', options.items, event => {
				event.stopPropagation();

				const $target  = $( event.target );
				const $subMenu = $target.children( '.sub-menu' );

				if ( $subMenu.length ) {

					let menuHeight = $menu.outerHeight();

					if ( 'true' === $target.attr( 'aria-expanded' ) ) {
						menuHeight -= $subMenu.outerHeight();
						$target.attr( 'aria-expanded', 'false' );
					} else {
						$target.attr( 'aria-expanded', 'true' );
						menuHeight += $subMenu.outerHeight();
					}

					$menu.css( 'max-height', menuHeight );
				}
			} );
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
			$el.css( 'max-height', '0' )
				.removeClass( 'is-expanded' )
				.attr( 'aria-expanded', 'false' );
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
				$el.css( 'max-height', height )
					.addClass( 'is-expanded' )
					.attr( 'aria-expanded', 'true' );
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
