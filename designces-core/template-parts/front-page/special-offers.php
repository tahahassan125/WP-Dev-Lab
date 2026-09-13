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

	<div class="pt-5 pb-5">

		<?php echo do_shortcode( '[sale_products columns=4 limit=4]' ); ?>

	</div>

</section>