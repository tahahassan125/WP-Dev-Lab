<?php
/**
 * Popular products section.
 *
 * @package Designces_Core
 */
?>

<section class="container popular-products">

	<h1 class="text-center pt-5">Popular Products</h1>

	<p class="text-center">
		We offer a number of high quality toys to help keep<br>
		your pets healthy and spoiled!
	</p>

	<div class="row pt-5 pb-5 popular-products__grid">

		<?php
		if ( class_exists( 'WooCommerce' ) ) {

			$popular_products = wc_get_products(
				array(
					'limit'   => 3,
					'status'  => 'publish',
					'orderby' => 'popularity',
					'order'   => 'DESC',
					'return'  => 'objects',
				)
			);

			foreach ( $popular_products as $product ) {

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