<?php
    $id = $args['id'] ?? 0;
    $is_active = $args['is_active'] ?? false;
    $template = $args['template'] ?? '';
    ?>
    <div data-active="<?= $is_active ? 'true' : 'false' ?>"
         id="<?= esc_attr($id) ?>"
         class="hidden tab-item data-[active=true]:block">
        <div class="mt-10">
            <?php wc_get_template($template,); ?>
        </div>
    </div>
