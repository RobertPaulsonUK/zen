<?php
    $title = get_the_title();
    $image_id = get_post_thumbnail_id(get_the_ID());
    $image_src = wp_get_attachment_image_src($image_id, 'full')[0];
    ?>
    <div class="flex gap-[20px] items-center">
        <div class="shrink-0">
            <a href="<?= esc_url(get_permalink()) ?>">
                <img src="<?= esc_url($image_src) ?>"
                     alt="<?= esc_attr($title) ?>"
                     width="120px"
                     height="80px"
                     title="<?= esc_attr($title) ?>" class="max-h-20 object-cover">
            </a>
        </div>
        <a href="<?= esc_url(get_permalink()) ?>">
            <h3 class="text-neutral-800 text-sm font-normal text-left">
                <?= esc_html($title) ?>
            </h3>
        </a>
    </div>
