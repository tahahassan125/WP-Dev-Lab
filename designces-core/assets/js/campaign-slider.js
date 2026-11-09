/**
 * Designces Core — Campaign Product Slider
 *
 * Handles campaign product navigation and visibility
 * of Previous / Next buttons.
 */

document.addEventListener("DOMContentLoaded", function () {
  const sliders = document.querySelectorAll(".campaign-section__products");

  sliders.forEach(function (slider) {
    const track = slider.querySelector("[data-campaign-track]");
    const prevButton = slider.querySelector("[data-campaign-prev]");
    const nextButton = slider.querySelector("[data-campaign-next]");

    // Required slider elements.
    if (!track || !prevButton || !nextButton) {
      return;
    }

    /**
     * Position navigation arrows at the center
     * of the product image area.
     */
    function updateNavigationPosition() {
      const firstProduct = track.querySelector(".product-card");
      const media = firstProduct?.querySelector(".product-card__media");

      if (!media) {
        return;
      }

      const sliderRect = slider.getBoundingClientRect();
      const mediaRect = media.getBoundingClientRect();

      const mediaCenter = mediaRect.top - sliderRect.top + mediaRect.height / 2;

      slider.style.setProperty("--campaign-nav-center", `${mediaCenter}px`);
    }

    /**
     * Update navigation button visibility.
     */
    function updateNavigation() {
      const maxScroll = track.scrollWidth - track.clientWidth;

      // Hide both buttons when all products fit in the visible area.
      if (maxScroll <= 2) {
        prevButton.hidden = true;
        nextButton.hidden = true;
        return;
      }

      // Previous button is available only after scrolling.
      prevButton.hidden = track.scrollLeft <= 2;

      // Next button is hidden at the end of the slider.
      nextButton.hidden = track.scrollLeft >= maxScroll - 2;
    }

    /**
     * Move products forward by one visible slider area.
     */
    nextButton.addEventListener("click", function () {
      track.scrollBy({
        left: track.clientWidth,
        behavior: "smooth",
      });
    });

    /**
     * Move products backward by one visible slider area.
     */
    prevButton.addEventListener("click", function () {
      track.scrollBy({
        left: -track.clientWidth,
        behavior: "smooth",
      });
    });

    // Update buttons during manual scrolling and touch gestures.
    track.addEventListener("scroll", updateNavigation);

    // Recalculate navigation on window resize.
    window.addEventListener("resize", function () {
      updateNavigation();
      updateNavigationPosition();
    });

    // Initial slider state and arrow position.
    updateNavigation();
    updateNavigationPosition();

    // Observe layout changes, including responsive image sizing.
    if ("ResizeObserver" in window) {
      const resizeObserver = new ResizeObserver(function () {
        updateNavigation();
        updateNavigationPosition();
      });

      resizeObserver.observe(track);

      const firstMedia = track.querySelector(".product-card__media");

      if (firstMedia) {
        resizeObserver.observe(firstMedia);
      }
    }
  });
  
});
