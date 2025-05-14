<?php
    $is_mobile = $args['is_mobile'] ?? false;
    $classes = $is_mobile ? 'block md:hidden' : 'hidden md:block';
    $classes .= ' shrink-0';
  if(is_user_logged_in()):?>
    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="<?= esc_attr($classes) ?>">
        <img src="<?= get_template_directory_uri() ?>/assets/images/icons/avatar.svg" width="20px" height="20px" alt="avatar">
    </a>
<?php else: ?>
      <button class="cursor-pointer auth-init-button <?= esc_attr($classes) ?>">
          <img src="<?= get_template_directory_uri() ?>/assets/images/icons/avatar.svg" width="20px" height="20px" alt="avatar">
      </button>
<?php endif; ?>
