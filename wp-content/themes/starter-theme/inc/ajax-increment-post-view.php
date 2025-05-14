<?php
    add_action('wp_ajax_increment_post_view', 'ajax_increment_post_view');
    add_action('wp_ajax_nopriv_increment_post_view', 'ajax_increment_post_view');

    function ajax_increment_post_view() {
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

        if ($post_id && get_post_type($post_id) === 'post') {
            $views = (int) get_post_meta($post_id, 'views', true);
            update_post_meta($post_id, 'views', $views + 1);
        }
        wp_die();
    }
