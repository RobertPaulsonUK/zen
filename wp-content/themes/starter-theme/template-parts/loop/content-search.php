<?php
    global $product;
    if(!$product) {
        return;
    }
    $name = $product->get_name();
    $image_id = $product->get_image_id();
    $image_url = $image_id ? wp_get_attachment_image_src($image_id,'thumbnail')[0] : wc_placeholder_img_src( 'woocommerce_single' );
    $permalink = $product->get_permalink();
    ?>
    <li>
        <a href="<?= esc_url($permalink) ?>">
            <div class="flex items-center gap-4">
                <img width="50px" height="50px"
                     src="<?= esc_url($image_url) ?>"
                     title="<?= esc_attr($name) ?>"
                     alt="<?= esc_attr($name) ?>">
                <h3 class="text-base font-semibold text-neutral-800">
                    <?= esc_html($name) ?>
                </h3>
            </div>
        </a>
    </li>
