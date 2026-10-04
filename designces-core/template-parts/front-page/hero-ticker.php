<?php

/**
 * Front-page hero ticker.
 *
 * @package Designces_Core
 */

$ticker_items = array(
	'FREE SHIPPING ON ORDERS OVER €50',
	'30 DAYS MONEY BACK GUARANTEE',
	'NEW ARRIVALS ARE HERE',
	'SHOP NOW',
	'SECURE CHECKOUT',
	'EXCLUSIVE OFFERS',
);
?>

<section
	class="hero-ticker"
	aria-label="<?php esc_attr_e('Store announcements', 'designces-core'); ?>">

	<div class="hero-ticker__track">

		<?php for ($group = 0; $group < 4; $group++) : ?>

			<div
				class="hero-ticker__group"
				<?php echo 0 !== $group ? 'aria-hidden="true"' : ''; ?>>

				<?php foreach ($ticker_items as $ticker_item) : ?>

					<div class="hero-ticker__item">
						<span aria-hidden="true">★</span>
						<?php echo esc_html($ticker_item); ?>
					</div>

				<?php endforeach; ?>

			</div>

		<?php endfor; ?>

	</div>

</section>