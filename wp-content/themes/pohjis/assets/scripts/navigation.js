/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var html, body, head, container, button, menu, links, i, len, header, fixedHeader, mainNavWrapper, focusableElements, firstFocusableElement, lastFocusableElement;

	// Main nav.
	container = document.getElementById( 'site-navigation' );

	// Bail if there is no main navigation.
	if ( ! container ) {
		return;
	}

	// Vars.
	body        = document.getElementsByTagName('body')[0];
	html        = document.getElementsByTagName( 'html' )[0];
	head        = document.getElementsByTagName( 'head' )[0]
	header      = document.getElementById( 'masthead' );
	fixedHeader = document.getElementById( 'site-branding-menu-wrapper' );

	button         = document.getElementById( 'menu-toggle' );
	menu           = document.getElementById( 'primary-menu' );
	mainNavWrapper = document.getElementById( 'primary-menu-wrapper' );

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	// Open menu on click.
	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			closeMenu(); // Close menu.
		} else {
			html.className      += ' disable-scroll';
			body.className      += ' main-navigation-open';
			container.className += ' toggled';
			container.className += ' fadeIn';
			menu.className      += ' fadeInDown';
			button.className    += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );

			// Set focusable elements inside main navigation.
			focusableElements     = container.querySelectorAll( ['a[href]', 'area[href]', 'input:not([disabled])', 'select:not([disabled])', 'textarea:not([disabled])', 'button:not([disabled])', 'iframe', 'object', 'embed', '[contenteditable]', '[tabindex]:not([tabindex^="-"])'] );
			firstFocusableElement = focusableElements[0];
			lastFocusableElement  = focusableElements[focusableElements.length - 1];

			// Redirect last Tab to first focusable element.
			lastFocusableElement.addEventListener( 'keydown', function ( e ) {
				if ( ( e.keyCode === 9 && ! e.shiftKey ) ) {
					e.preventDefault();
					button.focus(); // Set focus on first element - that's actually close menu button.
				}
			});

			// Redirect Shift+Tab on button to last focusable element.
			button.addEventListener( 'keydown', function ( e ) {
				if ( ( e.keyCode === 9 && e.shiftKey ) ) {
					e.preventDefault();
					lastFocusableElement.focus(); // Set focus on last element.
				}
			});
		}
	};

	// Close menu using Esc key.
	document.addEventListener( 'keyup', function( event ) {
		if ( event.keyCode == 27 ) {
			if ( -1 !== container.className.indexOf( 'toggled' ) ) {
				closeMenu(); // Close menu.
			}
		}
	});

	// Close menu function.
	function closeMenu() {
		container.className = container.className.replace( ' fadeIn', '' );
		container.className += ' fadeOut';
		menu.className = menu.className.replace( ' fadeInDown', '' );
		menu.className += ' fadeOutUp';
		button.className = button.className.replace( ' toggled', '' );

		setTimeout( function() {
			html.className = html.className.replace( ' disable-scroll', '' );
			body.className = body.className.replace( ' main-navigation-open', '' );
			container.className = container.className.replace( ' toggled', '' );
			container.className = container.className.replace( ' fadeOut', '' );
			menu.className = menu.className.replace( ' fadeOutUp', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
			button.focus();
		}, 350 );
	}

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		// Bail if we are on mobile.
		//button = document.getElementById( 'menu-toggle' );
		if ( window.getComputedStyle( button, null ).getPropertyValue( 'display' ) === 'none' ) {
			return;
		}

		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
