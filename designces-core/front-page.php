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
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();