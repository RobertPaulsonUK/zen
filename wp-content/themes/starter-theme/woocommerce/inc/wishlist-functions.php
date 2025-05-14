<?php
    function is_product_in_wishlist(int $product_id):bool
    {
        return WooWishlistClass::check_is_product_in_list($product_id);
    }
//    Ajax register
    add_action('wp_ajax_custom_wishlist_handler', 'ajax_wishlist_product_handler');
    add_action('wp_ajax_nopriv_custom_wishlist_handler', 'ajax_wishlist_product_handler');

    function ajax_wishlist_product_handler()
    {
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $process = isset($_POST['process']) ? sanitize_text_field($_POST['process']) : 'add';
        if (!class_exists('WooWishlistClass')) {
            wp_send_json_error(['message' => 'Wishlist class not found']);
        }
        $WooWishlist = new WooWishlistClass($product_id);
        if($process === 'add') {
            $is_success = $WooWishlist->add_product_to_wishlist();
            $message = __('Product added to wishlist successfully','robert-theme');
        } else {
            $is_success = $WooWishlist->remove_product_from_wishlist();
            $message = __('Product removed from wishlist successfully','robert-theme');
        }
        if (is_wp_error($is_success)) {
            wp_send_json_error(['message' => __('Oops, something went wrong...<br>Please try it later','robert-theme')]);
        }
        wp_send_json_success(['message' => $message]);

    }