<?php
    $iframe = get_field('google_map_iframe','option');
    if(empty($iframe)) {
        return;
    }
    $container = $args['container'] ?? false;
    $classes = $container ? 'container mx-auto px-[16px] map-wrapper' : 'w-full h-full min-h-500px map-wrapper';
    ?>
    <div class="<?= esc_attr($classes) ?>">
        <?= $iframe ?>
    </div>
