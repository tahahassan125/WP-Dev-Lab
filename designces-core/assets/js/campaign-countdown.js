
/**
 * Designces Core — Campaign Countdown
 *
 * Updates the campaign countdown using the end date
 * provided by the WordPress ACF field.
 */

document.addEventListener('DOMContentLoaded', function () {

    const countdowns = document.querySelectorAll('.campaign-countdown');

    countdowns.forEach(function (countdown) {

        const endTime = countdown.dataset.endTime;

        if (!endTime) {
            return;
        }

        const endDate = new Date(endTime).getTime();

        if (Number.isNaN(endDate)) {
            return;
        }

        // Countdown display elements.
        const daysElement = countdown.querySelector('[data-countdown-days]');
        const hoursElement = countdown.querySelector('[data-countdown-hours]');
        const minutesElement = countdown.querySelector('[data-countdown-minutes]');
        const secondsElement = countdown.querySelector('[data-countdown-seconds]');

        if (!daysElement || !hoursElement || !minutesElement || !secondsElement) {
            return;
        }

        let timerInterval;

        function updateCountdown() {

            const currentTime = Date.now();
            const remainingTime = endDate - currentTime;

            // Stop countdown when the campaign expires.
            if (remainingTime <= 0) {

                daysElement.textContent = '00';
                hoursElement.textContent = '00';
                minutesElement.textContent = '00';
                secondsElement.textContent = '00';

                clearInterval(timerInterval);

                return;
            }

            // Calculate remaining time.
            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));

            const hours = Math.floor(
                (remainingTime / (1000 * 60 * 60)) % 24
            );

            const minutes = Math.floor(
                (remainingTime / (1000 * 60)) % 60
            );

            const seconds = Math.floor(
                (remainingTime / 1000) % 60
            );

            // Update countdown display.
            daysElement.textContent = String(days).padStart(2, '0');
            hoursElement.textContent = String(hours).padStart(2, '0');
            minutesElement.textContent = String(minutes).padStart(2, '0');
            secondsElement.textContent = String(seconds).padStart(2, '0');
        }

        // Display immediately, then update every second.
        updateCountdown();

        timerInterval = setInterval(updateCountdown, 1000);

    });

});
