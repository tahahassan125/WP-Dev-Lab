<?php
/**
 * Reusable WooCommerce product card.
 *
 * Expected:
 * $args['product'] = WC_Product object
 *
 * @package Designces_Core
 */

$product = isset( $args['product'] ) ? $args['product'] : $GLOBALS['product'];

if ( ! $product instanceof WC_Product ) {
	return;
}
?>

<article <?php wc_product_class( 'product-card', $product ); ?>>

	<div class="product-card__image">

		<a
			class="product-card__image-link"
			href="<?php echo esc_url( $product->get_permalink() ); ?>"
		>
			<?php
			echo $product->get_image(
				'woocommerce_thumbnail',
				array(
					'class' => 'product-card__image-img',
				)
			);
			?>

			<?php if ( $product->is_on_sale() ) : ?>
				<span class="product-card__sale">
					<?php esc_html_e( 'Sale!', 'designces-core' ); ?>
				</span>
			<?php endif; ?>
		</a>

	</div>

	<div class="product-card__content">

		<h2 class="product-card__title">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo esc_html( $product->get_name() ); ?>
			</a>
		</h2>

		<div class="product-card__price">
			<?php echo wp_kses_post( $product->get_price_html() ); ?>
		</div>

		<div class="product-card__actions">
			<?php
			woocommerce_template_loop_add_to_cart(
				array(
					'product' => $product,
				)
			);
			?>
		</div>

	</div>

</article>