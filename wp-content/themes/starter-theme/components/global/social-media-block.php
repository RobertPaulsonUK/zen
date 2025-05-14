<?php
    $social_items = get_field('social_media_repeater','option');
    if(empty($social_items)) {
        return;
    }
    $margin_class = $args['margin_class'] ?? 'mt-[30px]';
    ?>
    <div class="<?= esc_attr($margin_class) ?> py-[30px] text-center">
        <h3 class="text-neutral-100 text-sm font-semibold uppercase">
            <?php esc_html_e('Follow us on social media','robert-theme'); ?>
        </h3>
        <div class="flex gap-4 justify-center mt-[20px]">
            <?php foreach ($social_items as $item): ?>
                <div class="flex justify-center items-center w-[24px] h-[24px] bg-light-brown">
                    <a href="<?= esc_url($item['url']) ?>">
                        <?php print_simple_images($item['icon'],'max-w-full max-h-full object-contain'); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
