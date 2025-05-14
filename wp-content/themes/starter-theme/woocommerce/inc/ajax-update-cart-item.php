<?php

    add_action('wp_ajax_zen_update_cart_item_qty', 'ajax_wcc_update_cart_item');
    add_action('wp_ajax_nopriv_zen_update_cart_item_qty', 'ajax_wcc_update_cart_item');

    function ajax_wcc_update_cart_item()
    {
        ob_start();

        $quantity      = empty($_POST['quantity']) ? 0 : wc_stock_amount($_POST['quantity']);
        $cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';

        $cart_item = WC()->cart->get_cart_item($cart_item_key);
        if ( ! $cart_item) {
            wp_send_json_error(array('message' => 'Item not found in cart.'));
            die();
        }

        WC()->cart->set_quantity($cart_item_key, $quantity);
        WC()->cart->calculate_totals();

        WC_AJAX::get_refreshed_fragments();

        die();
    }