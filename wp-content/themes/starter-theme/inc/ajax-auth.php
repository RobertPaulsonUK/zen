<?php
    add_action('wp_ajax_zen_register_user', 'ajax_register_user');
    add_action('wp_ajax_nopriv_zen_register_user', 'ajax_register_user');

    function ajax_register_user() {
        $login = sanitize_text_field($_POST['login']) ?? null;
        $password = sanitize_text_field($_POST['password']) ?? null;
        $password_complete = sanitize_text_field($_POST['password_complete']) ?? null;
        if ( ! isset($_POST['woocommerce-register-nonce']) ||
             ! wp_verify_nonce($_POST['woocommerce-register-nonce'], 'woocommerce-register') ) {
            wp_die('Security error');
        }
        if(!$login || !$password) {
            wp_send_json_error(
                array('message' => __('No password or login provided','robert-theme'),
                    'fields' => ['login','password']),
            400);
        }
        if($password !== $password_complete) {
            wp_send_json_error(
                array('message' => __('Please confirm password correctly','robert-theme'),
                      'fields' => ['password','password_complete']),
                400);
        }
        if(username_exists($login)) {
            wp_send_json_error(array(
                'message' => __('There is already user with this login','robert-theme'),
                'fields' => ['login']
            ),400);
        }
        if(email_exists($login)) {
            wp_send_json_error(array(
                'message' => __('There is already user with this email','robert-theme'),
                'fields' => ['login']
            ),400);
        }
        if(is_email($login)) {
            $email = $login;
            $login = sanitize_user(current(explode('@', $email)));
            $original_login = $login;
            if(username_exists($login)) {
                $counter = 1;
                while (username_exists($login)) {
                    $login = $original_login . $counter;
                    $counter++;
                }
            }
            $user_id = wp_create_user(sanitize_text_field($original_login),sanitize_text_field($password),$email);
        } else {
            $user_id = wp_create_user(sanitize_text_field($login),sanitize_text_field($password));
        }
        if ( is_wp_error( $user_id ) ) {
            wp_send_json_error(array(
                'message' => $user_id->get_error_message(),
                'fields' => []
            ),500);
        }
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id, true);
        $data = array(
            'success' => true,
            'message' => __('User has been created successfully','robert-theme'),
            'redirect' => get_permalink( get_option('woocommerce_myaccount_page_id'))
        );
        wp_send_json($data);
    }

    add_action('wp_ajax_zen_login_user', 'ajax_login_user');
    add_action('wp_ajax_nopriv_zen_login_user', 'ajax_login_user');

    function ajax_login_user() {
        $input_login = sanitize_text_field($_POST['login']) ?? null;
        $password = sanitize_text_field($_POST['password']) ?? null;
        $remember = (bool)$_POST['remember'];
        if ( ! isset($_POST['woocommerce-login-nonce']) ||
             ! wp_verify_nonce($_POST['woocommerce-login-nonce'], 'woocommerce-login') ) {
            wp_die('Security error');
        }
        if(!$input_login || !$password) {
            wp_send_json_error(array
            ('message' => __('No password or login provided','robert-theme'),
                'fields' => ['login','password']),
                400);
        }
        if(is_email($input_login)) {
            $user = get_user_by('email', $input_login);
            if ($user) {
                $login = $user->user_login;
            } else {
                wp_send_json_error(array('message' => __('There is no user with provided email','robert-theme'),
                    'fields' => ['login']),400);
            }
        } else {
            $login = $input_login;
        }
        $credentials = [
            'user_login' => $login,
            'user_password' => $password,
            'remember'      => $remember
        ];
        $user = wp_signon($credentials, false);

        if (is_wp_error($user)) {
            wp_send_json_error(array(
                'message' => $user->get_error_message(),
                'fields' => ['password','login']
            ),400);
        }
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, $remember);
        $data = array(
            'success' => true,
            'message' => __('User has been logged in successfully','robert-theme'),
            'redirect' => get_permalink( get_option('woocommerce_myaccount_page_id'))
        );
        wp_send_json($data);
    }