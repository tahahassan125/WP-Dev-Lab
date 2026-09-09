<?php
/**
 * Main header.
 *
 * @package Designces_Core
 */
?>

<header id="masthead" class="site-header">

	<div class="container pt-2 pb-2">

		<div class="row align-items-center">

			<!-- Logo -->
			<div class="col site-header__logo d-flex justify-content-center justify-content-md-start">
				<?php the_custom_logo(); ?>
			</div>

			<!-- Search -->
			<div class="col-sm-12 col-md-5">
				<?php
				if ( function_exists( 'aws_get_search_form' ) ) {
					aws_get_search_form();
				}
				?>
			</div>

			<!-- Cart -->
			<div class="col cart d-flex justify-content-center justify-content-md-end align-items-center pt-2">

				<?php if ( function_exists( 'WC' ) && WC()->cart ) : ?>

					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'View shopping cart', 'designces-core' ); ?>">
						<i class="bi bi-bag-dash p-2"></i>
					</a>

					<a
						class="cart-customlocation"
						href="<?php echo esc_url( wc_get_cart_url() ); ?>"
						title="<?php esc_attr_e( 'View your shopping cart', 'designces-core' ); ?>"
					>
						<?php
						printf(
							/* translators: 1: number of items, 2: cart total. */
							_n(
								'%1$d item – %2$s',
								'%1$d items – %2$s',
								WC()->cart->get_cart_contents_count(),
								'designces-core'
							),
							WC()->cart->get_cart_contents_count(),
							WC()->cart->get_cart_total()
						);
						?>
					</a>

				<?php endif; ?>

			</div>

		</div>

	</div>

</header><!-- #masthead -->