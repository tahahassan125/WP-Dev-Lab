/**
 * Designces Core
 *
 * Theme-specific JavaScript.
 */

(function () {
	'use strict';

	/**
	 * =====================================================
	 * MOBILE NAVIGATION — HEADER OFFSET
	 * =====================================================
	 *
	 * Purpose:
	 * The mobile navigation uses Bootstrap's Responsive
	 * Offcanvas component.
	 *
	 * Bootstrap normally positions an Offcanvas panel from
	 * the top of the viewport. However, our Designces Core
	 * navigation should open BELOW the main header so that
	 * the header remains visible.
	 *
	 * Example:
	 *
	 *   Main Header
	 *   ─────────────────────
	 *   Navigation Offcanvas
	 *   ─────────────────────
	 *
	 * Bootstrap remains responsible for the actual Offcanvas
	 * functionality:
	 *
	 * - opening and closing
	 * - slide animation
	 * - backdrop
	 * - ESC key
	 * - focus management
	 *
	 * This script does NOT control the Offcanvas.
	 *
	 * Its only responsibility is to measure the actual
	 * position of the main header and pass that value to
	 * CSS through the custom property:
	 *
	 * --designces-main-header-bottom
	 *
	 * The SCSS then uses this value as the Offcanvas
	 * `top` position.
	 *
	 * Why measure it dynamically?
	 *
	 * The header height can change depending on:
	 *
	 * - screen size
	 * - logo size
	 * - cart content
	 * - search visibility
	 * - WordPress Admin Bar
	 * - other responsive layout changes
	 *
	 * Therefore, we do not hardcode a value such as 60px
	 * or 80px.
	 */

	function updateNavigationOffset() {

		/**
		 * Find the main Designces Core header.
		 */
		const header = document.querySelector('.site-header');

		/**
		 * If the header does not exist on a particular page,
		 * there is nothing to measure.
		 */
		if (!header) {
			return;
		}

		/**
		 * Get the header's bottom position relative to
		 * the viewport.
		 *
		 * Example:
		 * If the header ends at 124px from the top,
		 * `headerBottom` will be approximately 124.
		 */
		const headerBottom = header.getBoundingClientRect().bottom;

		/**
		 * Store the measured value as a CSS custom property
		 * on the root <html> element.
		 *
		 * The SCSS navigation can then use:
		 *
		 * top: var(--designces-main-header-bottom);
		 *
		 * Math.max() prevents a negative value.
		 */
		document.documentElement.style.setProperty(
			'--designces-main-header-bottom',
			`${Math.max(0, headerBottom)}px`
		);
	}


	/**
	 * =====================================================
	 * INITIAL MEASUREMENT
	 * =====================================================
	 *
	 * Calculate the header position when the page loads.
	 */
	updateNavigationOffset();


	/**
	 * =====================================================
	 * WINDOW RESIZE
	 * =====================================================
	 *
	 * Recalculate the header position whenever the viewport
	 * size changes.
	 *
	 * This is important because the header layout changes
	 * between mobile, tablet and desktop breakpoints.
	 */
	window.addEventListener('resize', updateNavigationOffset);


	/**
	 * =====================================================
	 * HEADER SIZE CHANGES
	 * =====================================================
	 *
	 * ResizeObserver watches the actual header element.
	 *
	 * If the header's size changes without a window resize,
	 * for example because of:
	 *
	 * - different content
	 * - logo size changes
	 * - responsive changes
	 * - dynamic WooCommerce cart content
	 *
	 * the navigation offset is recalculated automatically.
	 */
	if ('ResizeObserver' in window) {

		const header = document.querySelector('.site-header');

		if (header) {

			const headerObserver = new ResizeObserver(
				updateNavigationOffset
			);

			headerObserver.observe(header);
		}
	}

})();