<?php
    $title = $args['title'] ?? '';
    $id = $args['id'] ?? 0;
    $is_active = $args['is_active'] ?? false;
?>
<button data-tab-id="<?= esc_attr($id) ?>"
        data-active="<?= $is_active ? 'true' : 'false' ?>"
        class="tabs-btn cursor-pointer p-2 uppercase  border-b border-transparent transition-colors duration-300 linear data-[active=true]:border-neutral-800">
    <?= esc_html($title) ?>
</button>
