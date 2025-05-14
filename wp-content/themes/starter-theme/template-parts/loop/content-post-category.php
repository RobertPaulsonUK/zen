<?php
    $category = $args['category'] ?? null;
    $name = $category->name;
    $posts_count = $category->count;
    $permalink = get_term_link($category->term_id);
    if(!$category) {
        return;
    }
    ?>
    <div>
        <a href="<?= esc_url($permalink) ?>" class="text-neutral-800 text-sm text-left">
            <?= esc_html(sprintf('%s (%d)',$name,$posts_count)) ?>
        </a>
    </div>
