<?php

    add_action('wp_ajax_zen_view_account_order_item', 'ajax_wcc_view_order_item');
    add_action('wp_ajax_nopriv_zen_view_account_order_item', 'ajax_wcc_view_order_item');

    function ajax_wcc_view_order_item()
    {
        ob_start();

        $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;

        if ( ! $order_id) {
            wp_send_json_error(array('message' => 'Order id has been not provided'));
            die();
        }
        $output = ob_start(PHP_OUTPUT_HANDLER_CLEANABLE);
        get_template_part('components/woo/account/order','item',['order_id' => $order_id]);
        $output .= ob_get_clean();
        wp_send_json($output);
        wp_die();
    }