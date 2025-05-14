<?php
    $tag = $args['tag'] ?? null;
    if(!$tag) {
        return;
    }
    ?>
    <div class="w-fit py-2 px-3 border border-neutral-800">
        <a href="<?= esc_url(get_term_link($tag->term_id)) ?>"
           class="text-sm text-neutral-600 font-normal">
            <?= esc_html($tag->name) ?>
        </a>
    </div>
