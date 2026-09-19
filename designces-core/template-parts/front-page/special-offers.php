<?php
/**
 * Special offers section.
 *
 * @package Designces_Core
 */
?>

<section class="container pt-5 special-offers">

	<h1 class="text-center pt-5">Special Offers</h1>

	<p class="text-center">
		We offer a number of high quality toys to help keep<br>
		your pets healthy and spoiled!
	</p>

	<div class="row pt-5 pb-5 special-offers__grid">

		<?php
		if ( class_exists( 'WooCommerce' ) ) {

			$sale_products = wc_get_products(
				array(
					'limit'   => 3,
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