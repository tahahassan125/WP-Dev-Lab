
/**
 * Designces Core — Category Slider
 *
 * Purpose:
 * Controls the Previous and Next buttons for the
 * front-page WooCommerce category slider.
 *
 * Responsibilities:
 * - Scroll the category track horizontally.
 * - Provide smooth scrolling.
 * - Work alongside CSS scroll-snap.
 *
 * CSS remains responsible for the slider layout,
 * card sizing, responsive behavior and scroll-snap.
 */

(function () {
	'use strict';

	/**
	 * =====================================================
	 * INITIALIZE CATEGORY SLIDERS
	 * =====================================================
	 *
	 * Find category slider components on the page and
	 * attach their navigation controls.
	 *
	 * querySelectorAll() allows multiple instances of the
	 * component to work independently on the same page.
	 */
	function initializeCategorySliders() {

		const sliders = document.querySelectorAll('.category-slider');

		sliders.forEach(function (slider) {

			const track = slider.querySelector('.category-slider__track');
			const previousButton = slider.querySelector('.category-slider__prev');
			const nextButton = slider.querySelector('.category-slider__next');

			/*
			 * Skip incomplete slider markup safely.
			 */
			if (!track || !previousButton || !nextButton) {
				return;
			}

			/*
			 * Calculate how far the track should scroll
			 * when a navigation button is clicked.
			 *
			 * Scrolling by 80% of the visible width provides
			 * a useful movement without skipping too much
			 * of the category slider.
			 */
			function getScrollDistance() {
				return track.clientWidth * 0.8;
			}

			/*
			 * Previous button:
			 * Scroll the track towards the beginning.
			 */
			previousButton.addEventListener('click', function () {

				track.scrollBy({
					left: -getScrollDistance(),
					behavior: 'smooth'
				});

			});

			/*
			 * Next button:
			 * Scroll the track towards the end.
			 */
			nextButton.addEventListener('click', function () {

				track.scrollBy({
					left: getScrollDistance(),
					behavior: 'smooth'
				});

			});

		});
	}


	/**
	 * =====================================================
	 * INITIALIZATION
	 * =====================================================
	 *
	 * Wait until the document has been parsed before
	 * searching for the slider markup.
	 */
	if (document.readyState === 'loading') {

		document.addEventListener(
			'DOMContentLoaded',
			initializeCategorySliders
		);

	} else {

		initializeCategorySliders();

	}

})();
