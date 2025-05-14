<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package robert-theme
 */

    $image_id = get_post_thumbnail_id(get_the_ID());
    $image_src = wp_get_attachment_image_src($image_id, 'full')[0];
    $title = get_the_title();
?>

<section class="pb-section md:pb-section-desktop">
    <div class="container px-4 mx-auto">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="<?= esc_attr(heading_classes()) ?>">
                <?= esc_html($title) ?>
            </h1>
            <div class="mt-8">
                <img src="<?= esc_url($image_src) ?>"
                     class="w-full h-full max-w-[1000px] max-h-[500px] object-cover mx-auto"
                     alt="<?= esc_attr($title) ?>"
                     title="<?= esc_attr($title) ?>">
            </div>
            <div class="mt-8 text-block">
                <?php the_content(); ?>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
    </div>
</section>
<?php get_template_part('components/global/related','posts') ?>
