<?php
/**
 * Footer widget area.
 *
 * @package Designces_Core
 */
?>

<div class="bg-primary text-white pt-5 pb-5">

	<div class="container">

		<div class="row">

			<div class="col-sm-6 col-md-2">

				<?php dynamic_sidebar( 'footer-widget-col-one' ); ?>

			</div>

			<div class="col-sm-6 col-md-2">

				<?php dynamic_sidebar( 'footer-widget-col-two' ); ?>

			</div>

			<div class="col-md-4 col-sm-12 ms-auto">

				<?php dynamic_sidebar( 'footer-widget-col-three' ); ?>

			</div>

		</div>

	</div>

</div>