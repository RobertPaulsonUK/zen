<?php
    /**
     * Edit address form
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.3.0
     */

    defined( 'ABSPATH' ) || exit;


    $user_id = get_current_user_id();
    $woocommerce_countries = new WC_Countries();
    $countries = $woocommerce_countries->get_countries();
    $states = $woocommerce_countries->get_states(get_user_meta( $user_id, 'billing_country', true ));
    $billing_fields = [
        [
            'field' => 'billing_country',
            'label' => __('Country','robert-theme'),
        ],
        [
            'field' => 'billing_state',
            'label' => __('State','robert-theme'),
        ],
        [
            'field' => 'billing_city',
            'label' => __('City','robert-theme'),
        ],
        [
            'field' => 'billing_postcode',
            'label' => __('Postal code','robert-theme'),
        ],
        [
            'field' => 'billing_address_1',
            'label' => __('Address','robert-theme'),
        ],
        [
            'field' => 'billing_address_2',
            'label' => __('House / Apartment','robert-theme'),
        ],
    ];

?>

    <form id="form-edit-billing">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ( $billing_fields as $item ):
                $field = $item['field'];
                $label = $item['label'];
                $value = get_user_meta( $user_id, $field, true );
                if($field === 'billing_country'):?>
                <label class="form-label relative z-1">
                    <span class="form-title">
                        <?= esc_html( $label); ?>
                    </span>
                    <span class="pointer-events-none absolute black right-2.5 bottom-5.25 translate-y-1/2">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" aria-hidden="true" focusable="false"><path d="M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"></path></svg>
                    </span>
                    <select class="custom-select" autocomplete="country" name="<?= esc_attr($field) ?>" id="countries-select">
                        <option disabled value=""><?php esc_html_e('Select country'); ?></option>
                        <?php foreach ($countries as $code => $country): ?>
                            <option value="<?= esc_attr($code) ?>" <?= $value === $code ? 'selected' : '' ?>>
                                <?= esc_html($country) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <?php elseif ($field === 'billing_state'): ?>
                    <label class="form-label relative z-1">
                    <span class="form-title">
                        <?= esc_html( $label); ?>
                    </span>
                    <span class="pointer-events-none absolute black right-2.5 bottom-5.25 translate-y-1/2">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" aria-hidden="true" focusable="false"><path d="M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"></path></svg>
                    </span>
                    <select class="custom-select" autocomplete="state" name="<?= esc_attr($field) ?>" id="states-select">
                        <?php if(!empty($states)): ?>
                            <option disabled value=""><?php esc_html_e('Select state'); ?></option>
                            <?php foreach ($states as $code => $state): ?>
                                <option value="<?= esc_attr($code) ?>" <?= $value === $code ? 'selected' : '' ?>>
                                    <?= esc_html($state) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    </label>
                <?php else: ?>
                <label class="form-label">
                    <span class="form-title">
                        <?= esc_html( $label); ?>
                    </span>
                    <input type="text" class="input-text form-input" name="<?= esc_attr($field) ?>" value="<?php echo esc_attr( $value); ?>" />
                </label>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <p>
            <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <button type="submit" class="mx-auto max-w-[300px] w-full mt-4 flex items-center justify-center h-10 mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800"
                    name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
        </p>
    </form>
