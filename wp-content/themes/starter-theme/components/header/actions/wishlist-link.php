<?php
    $is_mobile = $args['is_mobile'] ?? false;
    $classes = $is_mobile ? 'block md:hidden' : 'hidden md:block';
    $classes .= ' shrink-0';
?>
<a href="#" class="<?= esc_attr($classes) ?>">
    <img width="20px" height="20px"
         src="<?= get_template_directory_uri() ?>/assets/images/icons/wishlist.svg" alt="heart">
</a>