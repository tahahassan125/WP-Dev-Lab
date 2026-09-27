<?php

/**
 * Primary navigation.
 *
 * Uses Bootstrap responsive Offcanvas on mobile
 * and a normal horizontal navigation on desktop.
 *
 * @package Designces_Core
 */
?>

<nav id="site-navigation" class="main-navigation bg-primary offcanvas-md offcanvas-start" tabindex="-1" aria-labelledby="site-navigation-title">

	<!-- Mobile Offcanvas Header -->
	<div class="offcanvas-header">

		<h2 id="site-navigation-title" class="offcanvas-title">
			<?php esc_html_e( 'Navigation', 'designces-core' ); ?>
		</h2>

		<button
			type="button"
			class="btn-close"
			data-bs-dismiss="offcanvas"
			data-bs-target="#site-navigation"
			aria-label="<?php esc_attr_e( 'Close navigation menu', 'designces-core' ); ?>"
		></button>

	</div>

	<!-- Navigation Content -->
	<div class="offcanvas-body">

		<div class="container d-flex justify-content-center">

			<div class="row">

				<div class="col-12 text-center">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>

				</div>

			</div>

		</div>

	</div>

</nav>