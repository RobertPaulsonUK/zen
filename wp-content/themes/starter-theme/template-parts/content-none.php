<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package robert-theme
 */

?>

<section class="no-results not-found py-section md:py-section-desktop min-h-[500px]">
    <div class="container px-4 mx-auto">
        <h1 class="<?= esc_attr(heading_classes()) ?>">
            <?php esc_html_e( 'Nothing Found', 'robert-theme' ); ?>
        </h1>
        <div class="text-block text-center mt-5">
            <?php
                if ( is_search() ) :
                    ?>

                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'robert-theme' ); ?></p>
                    <?php

                else :
                    ?>

                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'robert-theme' ); ?></p>
                    <?php

                endif;
            ?>
        </div><!-- .page-content -->
    </div>
</section><!-- .no-results -->
