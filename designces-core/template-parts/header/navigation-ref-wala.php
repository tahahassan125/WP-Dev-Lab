<?php

/**
 * Primary navigation.
 *
 * @package Designces_Core
 */
?>

<nav id="site-navigation" class="main-navigation bg-primary">

	<div class="container d-flex justify-content-center">

		<div class="row">

			<!-- Mobile menu toggle -->
			<div class="col-12 d-flex justify-content-center">

				<button
					class="menu-toggle"
					aria-controls="primary-menu"
					aria-expanded="false"
					aria-label="<?php esc_attr_e('Open navigation menu', 'designces-core'); ?>">
					<i class="bi bi-list" aria-hidden="true"></i>
				</button>

			</div>


			<!-- Primary menu -->
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

</nav>