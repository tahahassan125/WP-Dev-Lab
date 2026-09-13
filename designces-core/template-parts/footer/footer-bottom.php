<?php
/**
 * Footer bottom area.
 *
 * @package Designces_Core
 */
?>

<div class="container pt-2 pb-2">

	<div class="row d-flex align-items-center">

		<div class="col">

			<p>
				&copy; <?php bloginfo( 'name' ); ?> <?php echo esc_html( date( 'Y' ) ); ?>
				/ Created by
				<a href="#" target="_blank" rel="noopener noreferrer">Designces</a>
			</p>

		</div>

		<div class="col h-25 d-inline-block text-end">

			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/payment-methods.png' ); ?>"
				class="img-fluid"
				loading="lazy"
				alt="Payment methods"
			>

		</div>

	</div>

</div>