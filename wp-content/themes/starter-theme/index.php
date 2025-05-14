<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package robert-theme
 */

get_header();
?>

	<main class="main">
        <?php get_template_part('components/global/breadcrumbs') ?>
        <section class="py-section md:py-section-desktop">
            <div class="container px-4 mx-auto">
                <?php print_archive_title() ?>
                <?php if(have_posts()): ?>
                <div class="flex flex-col lg:flex-row gap-10 mt-10">
                    <div>
                        <div class="grid grid-cols-1 gap-y-[48px] md:gap-y-[32px] md:gap-x-[16px] md:grid-cols-2">
                            <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();

                                    /*
                                     * Include the Post-Type-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/loop/content','post');

                                endwhile;?>
                        </div>
                        <?php get_template_part('components/global/archive','pagination') ?>
                    </div>
                    <?php get_template_part('components/global/archive','sidebar'); ?>
                </div>
                <?php else: ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>
            </div>
        </section>
	</main><!-- #main -->

<?php
get_footer();
