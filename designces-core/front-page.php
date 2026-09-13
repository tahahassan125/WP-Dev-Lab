<?php
/**
 * The template for displaying the front page.
 *
 * @package Designces_Core
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	get_template_part( 'template-parts/front-page/hero', 'carousel' );

	get_template_part( 'template-parts/front-page/popular', 'products' );
	?>

</main><!-- #main -->

<?php
get_footer();