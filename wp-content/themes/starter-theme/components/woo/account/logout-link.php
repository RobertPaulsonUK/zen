<?php
    $redirect_url = home_url() . '?login';
?>
<div class="flex justify-end mb-5">
    <a href="<?= esc_url(wc_logout_url($redirect_url)) ?>" class="flex gap-2 items-center w-fit text-neutral-800 font-garamond font-semibold text-lg">
        <?php esc_html_e('Logout','robert-theme'); ?>
        <img width="24px" height="24px" src="<?= get_template_directory_uri() ?>/assets/images/icons/logout-icon.svg" alt="logout-icon">
    </a>
</div>