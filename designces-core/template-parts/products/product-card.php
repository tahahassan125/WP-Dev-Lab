<?php

/**
 * Reusable WooCommerce product card.
 *
 * @package Designces_Core
 *
 * @var WC_Product|null $card_product
 */

$card_product = $args['product'] ?? null;

if (! $card_product instanceof WC_Product) {
	return;
}

$product_id = $card_product->get_id();
?>

<article <?php wc_product_class( 'col-12 col-md-6 col-lg-4 product-card', $card_product ); ?>>

	<div class="product-card__image-wrap">

		<?php if ($card_product->is_on_sale()) : ?>

			<span class="product-card__badge">
				<?php esc_html_e('Sale!', 'designces-core'); ?>
			</span>

		<?php endif; ?>

		<a
			href="<?php echo esc_url(get_permalink($product_id)); ?>"
			class="product-card__image-link"
			aria-label="<?php echo esc_attr($card_product->get_name()); ?>">
			<?php
			echo wp_kses_post(
				$card_product->get_image(
					'woocommerce_thumbnail',
					array(
						'class' => 'product-card__image',
					)
				)
			);
			?>
		</a>

	</div>

	<div class="product-card__body">

		<h3 class="product-card__title">
			<a href="<?php echo esc_url(get_permalink($product_id)); ?>">
				<?php echo esc_html($card_product->get_name()); ?>
			</a>
		</h3>

		<div class="product-card__price">
			<?php echo wp_kses_post($card_product->get_price_html()); ?>
		</div>

		<?php if ($card_product->is_type('simple') && $card_product->is_purchasable() && $card_product->is_in_stock()) : ?>

			<a
				href="<?php echo esc_url($card_product->add_to_cart_url()); ?>"
				data-quantity="1"
				class="product-card__button add_to_cart_button ajax_add_to_cart"
				data-product_id="<?php echo esc_attr($product_id); ?>"
				data-product_sku="<?php echo esc_attr($card_product->get_sku()); ?>"
				aria-label="<?php echo esc_attr($card_product->add_to_cart_description()); ?>"
				rel="nofollow">
				<span>
					<?php esc_html_e('Add to cart', 'designces-core'); ?>
				</span>

				<i class="bi bi-arrow-right" aria-hidden="true"></i>
			</a>

		<?php else : ?>

			<a
				href="<?php echo esc_url(get_permalink($product_id)); ?>"
				class="product-card__button">
				<span>
					<?php echo esc_html($card_product->add_to_cart_text()); ?>
				</span>

				<i class="bi bi-arrow-right" aria-hidden="true"></i>
			</a>

		<?php endif; ?>

	</div>

</article>