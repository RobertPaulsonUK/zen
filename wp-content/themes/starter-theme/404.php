<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package robert-theme
 */

get_header();
?>

	<main id="primary" class="main">
    <?php get_template_part('components/global/breadcrumbs') ?>
		<section class="error-404 not-found py-section md:py-section-desktop">
			<div class="container mx-auto px-4">
                <h1 class="<?= esc_attr(heading_classes()) ?>">
                    <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'robert-theme' ); ?>
                </h1>
                <div class="text-center mt-7">
                    <p class="text-[120px] leading-[120px] text-bold text-neutral-800">
                        404
                    </p>
                    <a class="w-fit mt-7 mx-auto rounded flex cursor-pointer bg-neutral-100 items-center justify-center h-[40px] text-sm font-semibold uppercase py-[15px] px-8 text-center text-neutral-800 border border-neutral-800 transition-colors duration-300 linear hover:bg-neutral-800 hover:text-white-900"
                       href="<?= esc_url(home_url()) ?>">
                        <?php esc_html_e('Home','robert-theme'); ?>
                    </a>
                </div><!-- .page-content -->
            </div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
