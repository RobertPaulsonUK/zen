<?php
    function redirect_cart_to_homepage() {
        if (is_cart()) {
            wp_redirect(home_url(), 302);
            exit();
        }
    }
    add_action('template_redirect', 'redirect_cart_to_homepage');