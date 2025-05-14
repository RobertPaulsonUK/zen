<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package robert-theme
 */

get_header();
?>

	<main id="primary" class="main">
        <?php get_template_part('components/global/breadcrumbs') ?>
		<?php if ( have_posts() ) : ?>
            <section class="py-section md:py-section-desktop">
                <div class="container px-4 mx-auto">
                    <?php print_archive_title(); ?>
                    <ul class="mt-12 grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-8 xl:grid-cols-4 h-fit">
                       <?php while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/loop/content', 'product' );
                        endwhile; ?>
                    </ul>
                    <?php get_template_part('components/global/archive','pagination') ?>
                </div>
            </section>
        <?php else :
            get_template_part( 'template-parts/content', 'none' );
        endif; ?>
	</main><!-- #main -->

<?php
get_footer();
