<?php
    $is_mobile = $args['is_mobile'] ?? false;
    $classes = $is_mobile ? 'block md:hidden' : 'hidden md:block';
    $classes .= ' shrink-0 cursor-pointer';
?>
<?php if(is_user_logged_in()):?>
<a href="<?= esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') ) . '?tab=wishlist') ?>" class="<?= esc_attr($classes) ?>">
    <img width="20px" height="20px"
         src="<?= get_template_directory_uri() ?>/assets/images/icons/wishlist.svg" alt="heart">
</a>
<?php else: ?>
    <button class="<?= esc_attr($classes) ?> auth-init-button">
        <img width="20px" height="20px"
             src="<?= get_template_directory_uri() ?>/assets/images/icons/wishlist.svg" alt="heart">
    </button>
<?php endif; ?>
