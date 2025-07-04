<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package robert-theme
 */

get_header();
?>

	<main class="main">
        <?php get_template_part('components/global/breadcrumbs') ?>
		<?php while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
