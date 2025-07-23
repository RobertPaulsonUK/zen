<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package robert-theme
 */

?>

	<footer id="footer" class="bg-warm-black text-neutral-300">
	    <div class="container mx-auto px-[16px]">
            <div class="flex flex-col lg:flex-row lg:justify-between">
                <?php
                    get_template_part('components/footer/footer','info');
                    robert_register_footer_menu();
                ?>
            </div>
            <?php get_template_part('components/footer/footer','copyright'); ?>
        </div>
	</footer><!-- #colophon -->
    <?php get_template_part('components/global/search','modal') ?>
    <?php get_template_part('components/auth/auth') ?>
    <?php get_template_part('components/global/error','modal') ?>
    <?php get_template_part('components/global/success','modal') ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
