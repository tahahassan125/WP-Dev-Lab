<?php
/**
 * Special offers section.
 *
 * Displays published products currently on sale.
 * Reuses the shared WooCommerce product-card component.
 *
 * @package Designces_Core
 */
?>

<section class="container-fluid pt-5 special-offers">

	<h1 class="text-center pt-5">
		<?php esc_html_e( 'Special Offers', 'designces-core' ); ?>
	</h1>

	<p class="text-center">
		We offer a number of high quality toys to help keep
		your pets healthy and spoiled!
	</p>

	<div class="pt-5 pb-5 special-offers__grid">

		<?php
		if ( class_exists( 'WooCommerce' ) ) {

			$sale_products = wc_get_products(
				array(
					'limit'   => 6,
					'status'  => 'publish',
					'on_sale' => true,
					'return'  => 'objects',
				)
			);

			foreach ( $sale_products as $product ) {

				get_template_part(
					'template-parts/products/product-card',
					null,
					array(
						'product' => $product,
					)
				);

			}
		}
		?>

	</div>

</section>
