/**
 * Designces Core — Category Slider
 *
 * Purpose:
 * Provides manual horizontal scrolling and automatic
 * category scrolling without navigation buttons.
 *
 * Responsibilities:
 * - Support native touch and trackpad scrolling.
 * - Automatically move to the next category.
 * - Pause autoplay during user interaction.
 * - Resume autoplay after user inactivity.
 * - Pause autoplay when slider is outside the viewport.
 * - Respect the user's reduced-motion preference.
 *
 * CSS handles layout, card sizing and scroll-snap.
 */

(function () {
  "use strict";

  const AUTOPLAY_DELAY = 3500;
  const RESUME_DELAY = 5000;

  /**
   * Initialize all category sliders.
   */
  function initializeCategorySliders() {
    const sliders = document.querySelectorAll(".category-slider");

    sliders.forEach(function (slider) {
      const track = slider.querySelector(".category-slider__track");

      if (!track) {
        return;
      }

      // Respect reduced-motion accessibility preference.
      const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
      ).matches;

      if (prefersReducedMotion) {
        return;
      }

      let autoplayTimer = null;
      let resumeTimer = null;
      let isVisible = false;
      //let isHovered = false;
      let isFocused = false;
      let isInteracting = false;

      /**
       * Check whether the track has content to scroll.
       */
      function canScroll() {
        return track.scrollWidth > track.clientWidth + 2;
      }

      /**
       * Clear the autoplay timer.
       */
      function stopAutoplay() {
        if (autoplayTimer) {
          clearTimeout(autoplayTimer);
          autoplayTimer = null;
        }
      }

      /**
       * Schedule the next automatic movement.
       */
      function scheduleAutoplay() {
        stopAutoplay();

        if (!isVisible || isFocused || isInteracting || !canScroll()) {
          return;
        }

        autoplayTimer = setTimeout(function () {
          moveToNextCategory();

          scheduleAutoplay();
        }, AUTOPLAY_DELAY);
      }

      /**
       * Move the track to the next category.
       */
      function moveToNextCategory() {
        const firstCard = track.querySelector(".category-card");

        if (!firstCard || !canScroll()) {
          return;
        }

        const cardStyle = getComputedStyle(track);
        const gap = parseFloat(cardStyle.columnGap) || 0;

        const cardWidth = firstCard.getBoundingClientRect().width;
        const scrollDistance = cardWidth + gap;

        const maxScroll = track.scrollWidth - track.clientWidth;

        const nextPosition = track.scrollLeft + scrollDistance;

        // Return to the beginning after reaching the end.
        if (nextPosition >= maxScroll - 2) {
          track.scrollTo({
            left: 0,
            behavior: "smooth",
          });
        } else {
          track.scrollBy({
            left: scrollDistance,
            behavior: "smooth",
          });
        }
      }

      /**
       * Pause autoplay during user interaction.
       */
      function pauseAutoplay() {
        isInteracting = true;

        stopAutoplay();

        if (resumeTimer) {
          clearTimeout(resumeTimer);
        }

        resumeTimer = setTimeout(function () {
          isInteracting = false;

          scheduleAutoplay();
        }, RESUME_DELAY);
      }

      /**
       * Pause when keyboard focus enters the slider.
       */
      slider.addEventListener("focusin", function () {
        isFocused = true;
        stopAutoplay();
      });

      slider.addEventListener("focusout", function () {
        setTimeout(function () {
          isFocused = slider.contains(document.activeElement);

          scheduleAutoplay();
        }, 0);
      });

      /**
       * Detect manual touch, pointer and wheel interaction.
       */
      track.addEventListener("pointerdown", pauseAutoplay, {
        passive: true,
      });

      track.addEventListener("touchstart", pauseAutoplay, {
        passive: true,
      });

      track.addEventListener("wheel", pauseAutoplay, {
        passive: true,
      });

      track.addEventListener("keydown", pauseAutoplay);

      /**
       * Desktop click-and-drag scrolling.
       *
       * Users can drag from anywhere inside the slider track,
       * including category cards and empty track space.
       *
       * Normal cursor is maintained.
       */

      let isDragging = false;
      let hasDragged = false;

      let startX = 0;
      let startScrollLeft = 0;

      let activePointerId = null;

      const DRAG_THRESHOLD = 5;

      /**
       * Start dragging with the primary mouse button.
       */
      track.addEventListener("pointerdown", function (event) {
        // Only handle mouse input, not touch or pen.
        if (event.pointerType !== "mouse" || event.button !== 0) {
          return;
        }

        isDragging = true;
        hasDragged = false;

        activePointerId = event.pointerId;

        startX = event.clientX;
        startScrollLeft = track.scrollLeft;

        // Keep receiving pointer events outside the track.
        track.setPointerCapture(event.pointerId);
      });

      /**
       * Move the slider horizontally.
       */
      track.addEventListener("pointermove", function (event) {
        if (!isDragging || event.pointerId !== activePointerId) {
          return;
        }

        const distance = event.clientX - startX;

        // Ignore small movements to preserve normal clicks.
        if (Math.abs(distance) > DRAG_THRESHOLD) {
          hasDragged = true;
        }

        if (hasDragged) {
          event.preventDefault();

          track.scrollLeft = startScrollLeft - distance;
        }
      });

      /**
       * Finish dragging.
       */
      function stopDragging(event) {
        if (!isDragging || event.pointerId !== activePointerId) {
          return;
        }

        isDragging = false;
        activePointerId = null;
      }

      /**
       * Handle pointer release and cancellation.
       */
      track.addEventListener("pointerup", stopDragging);
      track.addEventListener("pointercancel", stopDragging);

      /**
       * Prevent native image and link dragging.
       */
      track.addEventListener("dragstart", function (event) {
        event.preventDefault();
      });

      /**
       * Prevent category navigation after dragging.
       * Normal clicks remain functional.
       */
      track.addEventListener(
        "click",
        function (event) {
          if (hasDragged) {
            event.preventDefault();
            event.stopPropagation();

            hasDragged = false;
          }
        },
        true,
      );

      /**
       * Pause autoplay when the page is hidden.
       */
      document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
          stopAutoplay();
        } else {
          scheduleAutoplay();
        }
      });

      /**
       * Start autoplay only when the slider is visible.
       */
      if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              isVisible = entry.isIntersecting;

              if (isVisible) {
                scheduleAutoplay();
              } else {
                stopAutoplay();
              }
            });
          },
          {
            threshold: 0.25,
          },
        );

        observer.observe(slider);
      } else {
        isVisible = true;
        scheduleAutoplay();
      }
    });
  }

  /**
   * Initialize after the document is ready.
   */
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeCategorySliders);
  } else {
    initializeCategorySliders();
  }
})();
