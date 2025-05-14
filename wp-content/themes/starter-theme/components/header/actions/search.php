<?php
    $is_mobile = $args['is_mobile'] ?? false;
    $classes = $is_mobile ? 'block md:hidden' : 'hidden md:block';
    $classes .= ' search-button shrink-0 cursor-pointer';
?>
<button class="<?= esc_attr($classes) ?>">
    <img width="20px" height="20px"
         src="<?= get_template_directory_uri() ?>/assets/images/icons/search.svg" alt="search-icon">
</button>
