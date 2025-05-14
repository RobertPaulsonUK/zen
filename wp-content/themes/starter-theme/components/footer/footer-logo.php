<?php
    $logo = get_field('footer_logo','options');
    if(empty($logo)) {
        return;
    }
    ?>

<div class="shrink-0">
    <a href="<?= esc_attr(home_url()) ?>">
        <img width="145px" height="38px" src="<?= esc_attr($logo['url']) ?>" alt="footer-logo">
    </a>
</div>
