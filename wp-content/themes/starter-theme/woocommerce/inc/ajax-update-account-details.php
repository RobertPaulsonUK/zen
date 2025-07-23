<?php

    add_action('wp_ajax_zen_update_account_info_general', 'ajax_wcc_update_account_general_information');

    function ajax_wcc_update_account_general_information()
    {
        if ( ! isset($_POST['save-account-details-nonce']) ||
             ! wp_verify_nonce($_POST['save-account-details-nonce'], 'save_account_details') ) {
            wp_die('Security error');
        }
       $user_email = sanitize_text_field($_POST['user_email']);
        $password_current = $_POST['password_current'] ?? '';
        $password_new     = $_POST['password_new'] ?? '';
        $password_repeat  = $_POST['password_repeat'] ?? '';

        $user_id = get_current_user_id();
        $user = get_userdata($user_id);
       $update_data = [
           'ID' => $user_id,
           'first_name' => sanitize_text_field($_POST['first_name']),
           'last_name' => sanitize_text_field($_POST['last_name']),
           'display_name' => sanitize_text_field($_POST['display_name']),
           'user_email' => $user_email
       ];
       if(($user_email !== $user->user_email) && (get_user_by('email',$user_email))) {
           wp_send_json_error(array('message' => __('There is already user with provided email','robert-theme'),
                                    'fields' => ['user_email']),400);
       }
       if(!empty($password_current)) {
           if(! wp_check_password( $password_current, $user->user_pass, $user_id )) {
               wp_send_json_error(array('message' => __('Please enter correct current password.','robert-theme'),
                                        'fields' => ['password_current']),400);
           }
           if($password_new !== $password_repeat) {
               wp_send_json_error(array('message' => __('Please confirm new password.','robert-theme'),
                                        'fields' => ['password_new','password_repeat']),400);
           }
           if(!empty($password_new)) $update_data['user_pass'] = $password_new;
       }

        $result = wp_update_user($update_data);

        if ( is_wp_error($result) ) {
            wp_send_json_error([
                'message' => $result->get_error_message(),
                'fields'  => []
            ], 500);
        }
       wp_send_json(['success' => true,
                     'message' => __('User data has been updated successfully','robert-theme')]);
    }

    add_action('wp_ajax_zen_get_current_states', 'ajax_wcc_get_current_states_of_country');

    function ajax_wcc_get_current_states_of_country()
    {
        $country = sanitize_text_field($_POST['country']) ?? null;
        if(!$country) wp_send_json_error(array('message' => __('No country provided','robert-theme'),),400);
        $woocommerce_countries = new WC_Countries();
        $states = $woocommerce_countries->get_states($country);
        wp_send_json(['data' => $states]);
    }

    add_action('wp_ajax_zen_update_user_billing_info', 'ajax_wcc_update_billing_fields');

    function ajax_wcc_update_billing_fields()
    {
        if ( ! isset($_POST['save-account-details-nonce']) ||
             ! wp_verify_nonce($_POST['save-account-details-nonce'], 'save_account_details') ) {
            wp_die('Security check failed');
        }
        $user_id = get_current_user_id();
        $allowed_billing_fields = [
            'billing_address_1',
            'billing_address_2',
            'billing_city',
            'billing_postcode',
            'billing_country',
            'billing_state',
        ];
        foreach ($allowed_billing_fields as $field) {
            if (isset($_POST[$field])) {
                update_user_meta($user_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
        wp_send_json(['success' => true,
                      'message' => __('User data has been updated successfully','robert-theme')]);
    }

