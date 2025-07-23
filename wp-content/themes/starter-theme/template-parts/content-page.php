<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package robert-theme
 */

?>

<section class="pb-section md:pb-section-desktop">
    <div class="container px-4 mx-auto">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="<?= esc_attr(heading_classes()) ?>">
                <?= esc_html($title) ?>
            </h1>
            <div class="mt-8 text-block">
                <?php the_content(); ?>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
    </div>
</section>

