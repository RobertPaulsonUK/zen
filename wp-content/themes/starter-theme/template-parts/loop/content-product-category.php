<?php
    $term = $args['term'] ?? null;
    if(!$term) {
        return;
    }
    $name = $term->name;
    $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
    $image_url = wp_get_attachment_url( $thumbnail_id );
?>
<div class="swiper-slide">
    <a href="<?= esc_url(get_term_link($term->term_id)) ?>" class="relative group">
        <img src="<?= esc_url($image_url) ?>"
             class="w-full h-full object-cover"
             height="255px"
             width="255px"
             alt="<?= esc_attr($name) ?>">
        <h4 class="absolute top-1/2 left-1/2 -translate-1/2 text-white-900 text-lg uppercase font-semibold z-[2] hover-hover:opacity-0 hover-hover:group-hover:opacity-[1] transition-opacity duration-300 linear w-full text-center">
            <?= esc_html($name) ?>
        </h4>
        <span class="absolute block inset-0 bg-black/40 z-[1] hover-hover:opacity-0 hover-hover:group-hover:opacity-[1] transition-opacity duration-300 linear blur-xl"></span>
    </a>
</div>