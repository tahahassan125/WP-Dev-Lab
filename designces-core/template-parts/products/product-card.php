<?php

/**
 * Reusable WooCommerce product card.
 *
 * Displays:
 * - Product image
 * - Optional hover image
 * - Product badges
 * - Product title
 * - Product price
 *
 * @package Designces_Core
 *
 * @var WC_Product|null $card_product
 */

$card_product = $args['product'] ?? null;

if (! $card_product instanceof WC_Product) {
	return;
}

$product_id  = $card_product->get_id();
$product_url = get_permalink($product_id);

/*
 * ---------------------------------------------------------
 * PRODUCT IMAGES
 * ---------------------------------------------------------
 *
 * The featured image is used as the primary image.
 *
 * If the product has a gallery image, the first gallery
 * image is used as the desktop hover image.
 *
 * The hover image is optional.
 */

$gallery_image_ids = $card_product->get_gallery_image_ids();

$hover_image_id = ! empty($gallery_image_ids)
	? $gallery_image_ids[0]
	: 0;
?>

<article
	<?php
	wc_product_class(
		'product-card',
		$card_product
	);
	?>>

	<!-- =====================================================
	     PRODUCT MEDIA
	     ===================================================== -->

	<div class="product-card__media">

		<a
			href="<?php echo esc_url($product_url); ?>"
			class="product-card__image-link"
			aria-label="<?php echo esc_attr($card_product->get_name()); ?>">

			<?php
			/*
			 * Primary product image.
			 */
			echo wp_kses_post(
				$card_product->get_image(
					'woocommerce_thumbnail',
					array(
						'class' => 'product-card__image',
					)
				)
			);
			?>

			<?php if ($hover_image_id) : ?>

				<?php
				/*
				 * Secondary gallery image.
				 *
				 * This image is displayed on desktop hover
				 * through CSS.
				 */
				echo wp_kses_post(
					wp_get_attachment_image(
						$hover_image_id,
						'woocommerce_thumbnail',
						false,
						array(
							'class' => 'product-card__image product-card__image--hover',
						)
					)
				);
				?>

			<?php endif; ?>

		</a>


		<!-- =================================================
		     PRODUCT BADGES
		     ================================================= -->

		<?php if ($card_product->is_on_sale()) : ?>

			<div class="product-card__badges">

				<span class="product-card__badge product-card__badge--sale">
					<?php esc_html_e('Sale', 'designces-core'); ?>
				</span>

			</div>

		<?php endif; ?>

	</div>


	<!-- =====================================================
	     PRODUCT CONTENT
	     ===================================================== -->

	<div class="product-card__content">

		<!-- Product title -->
		<h3 class="product-card__title">

			<a href="<?php echo esc_url($product_url); ?>">
				<?php echo esc_html($card_product->get_name()); ?>
			</a>

		</h3>


		<!-- Product price -->
		<div class="product-card__price">

			<?php
			echo wp_kses_post(
				$card_product->get_price_html()
			);
			?>

		</div>

	</div>

</article>