<?php
    add_action('wp_ajax_add_single_product_to_cart', 'robert_ajax_add_to_cart');
    add_action('wp_ajax_nopriv_add_single_product_to_cart', 'robert_ajax_add_to_cart');
    function robert_ajax_add_to_cart()
    {

        ob_start();

        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
        $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);

        $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : '';
        $variations = !empty($_POST['variations']) ? (array)$_POST['variations'] : '';
        $cart_item_data = !empty($_POST['cart_item_data']) ? (array)$_POST['cart_item_data'] : [];

        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, $cart_item_data);

        if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations)) {

            do_action('woocommerce_ajax_added_to_cart', $product_id);

            if (get_option('woocommerce_cart_redirect_after_add') == 'yes') {
                wc_add_to_cart_message($product_id);
            }

            WC_AJAX::get_refreshed_fragments();

        } else {

            $data = array(
                'error' => true,
                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
            );

            wp_send_json($data);

        }

        die();
    }