<?php
/**
 * Front-page hero carousel.
 *
 * @package Designces_Core
 */
?>

<section class="container pb-5 pt-4">

	<div
		id="heroCarousel"
		class="carousel carousel-dark slide overflow-hidden rounded"
		data-bs-ride="carousel"
	>

		<div class="carousel-indicators">

			<button
				type="button"
				data-bs-target="#heroCarousel"
				data-bs-slide-to="0"
				class="active"
				aria-current="true"
				aria-label="<?php esc_attr_e( 'Slide 1', 'designces-core' ); ?>"
			></button>

			<button
				type="button"
				data-bs-target="#heroCarousel"
				data-bs-slide-to="1"
				aria-label="<?php esc_attr_e( 'Slide 2', 'designces-core' ); ?>"
			></button>

		</div>

		<div class="carousel-inner">

			<div
				class="carousel-item active"
				data-bs-interval="10000"
			>
				<a href="#">
					<img
						src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/slider/slide-1.jpg' ); ?>"
						class="d-block w-100"
						alt=""
					>
				</a>
			</div>

			<div
				class="carousel-item"
				data-bs-interval="2000"
			>
				<a href="#">
					<img
						src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/slider/slide-2.jpg' ); ?>"
						class="d-block w-100"
						alt=""
					>
				</a>
			</div>

		</div>

		<button
			class="carousel-control-prev"
			type="button"
			data-bs-target="#heroCarousel"
			data-bs-slide="prev"
		>
			<span
				class="carousel-control-prev-icon"
				aria-hidden="true"
			></span>

			<span class="visually-hidden">
				<?php esc_html_e( 'Previous', 'designces-core' ); ?>
			</span>
		</button>

		<button
			class="carousel-control-next"
			type="button"
			data-bs-target="#heroCarousel"
			data-bs-slide="next"
		>
			<span
				class="carousel-control-next-icon"
				aria-hidden="true"
			></span>

			<span class="visually-hidden">
				<?php esc_html_e( 'Next', 'designces-core' ); ?>
			</span>
		</button>

	</div>

</section>