<?php
    $name = get_the_title();
    $content = wp_trim_words(get_the_content(),20,'...');
    $id = get_the_ID();
    $permalink = get_permalink($id);
    $tags = wp_get_post_tags($id);
    $date = get_the_date('d.m.Y');
    $views = get_post_meta($id,'views',true);
    $image_id = get_post_thumbnail_id($id);
    $image_src = wp_get_attachment_image_src($image_id, 'medium')[0];
    ?>
    <div class="flex flex-col gap-2">
        <a href="<?= esc_url($permalink) ?>">
            <img class="w-full object-cover h-[288px]"
                 width="352px"
                 height="228px"
                 src="<?= esc_url($image_src) ?>"
                 title="<?= esc_attr($name) ?>"
                 alt="<?= esc_attr($name) ?>">
        </a>
        <div class="flex flex-col w-full gap-3 text-left">
            <div class="flex justify-between items-center text-neutral-700 text-sm font-semibold">
                <span><?= esc_html($date) ?></span>
                <span><?= esc_html($views . ' ' . __('Views','robert-theme')) ?></span>
            </div>
            <h3 class="text-neutral-800 text-lg font-semibold">
                <?= esc_html($name) ?>
            </h3>
            <div class="text-sm text-neutral-700 line-clamp-2">
                <?= esc_html($content) ?>
            </div>
            <?php if(!empty($tags)): ?>
                <div class="flex gap-3 items-center flex-wrap">
                <?php foreach ($tags as $tag) {
                    get_template_part('template-parts/loop/content','post-tag',['tag' => $tag]);
                } ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
