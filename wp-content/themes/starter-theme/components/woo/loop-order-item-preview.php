<?php
    $order_item = $args['order_item'] ?? null;
    if(!$order_item) {
        return;
    }
    $_product = wc_get_product($order_item->get_product_id());
    $image_id = $_product->get_image_id();
    $image_url = $image_id ? wp_get_attachment_image_src($image_id,'thumbnail')[0] : wc_placeholder_img_src( 'woocommerce_single' );
    $total = $order_item->get_total();
    $quantity = $order_item->get_quantity();
    $price_per_item = $total / $quantity;
    $name = $order_item->get_name();
    ?>
    <li class="w-full flex items-center justify-between gap-2">
        <span class="flex items-center gap-2 justify-start">
            <span>
                <img width="50px" height="50px" src="<?= esc_url($image_url)?>" alt="<?= esc_attr($name) ?>">
            </span>
            <span>
                <?= esc_html($name) ?>
            </span>
        </span>
        <span>
            <?= sprintf('%s x %s',$quantity,wc_price($price_per_item)); ?>
        </span>
    </li>
