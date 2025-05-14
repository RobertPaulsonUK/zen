<?php
    $worker = $args['worker'] ?? null;
    if(!$worker || !is_array($worker)) {
        return;
    }
    $image = $worker['image'];
    $name = $worker['name'];
    $job = $worker['job_title'];
    ?>
    <div class="swiper-slide">
        <div>
            <img class="w-full h-full object-cover"
                 height="321px"
                 width="255px"
                 src="<?= esc_url($image['url']) ?>"
                 alt="<?= esc_attr($name) ?>"
                 title="<?= esc_attr($name) ?>">
        </div>
        <div class="pt-[20px] text-center uppercase">
            <h4 class="text-sm font-semibold text-neutral-800">
                <?= esc_html($name) ?>
            </h4>
            <div class="text-neutral-600 mt-[12px] text-sm font-normal">
                <span><?= esc_html($job) ?></span>
            </div>
        </div>
    </div>
