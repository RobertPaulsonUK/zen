<?php
    /**
     * Edit account form
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.7.0
     */

    defined( 'ABSPATH' ) || exit;

    $user = get_user_by('id',get_current_user_id());
?>

    <form class="woocommerce-EditAccountForm edit-account" id="form-edit-account-form" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

        <?php do_action( 'woocommerce_edit_account_form_start' ); ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex flex-col items-center gap-4">
                <label class="form-label">
                <span class="form-title">
                    <?php esc_html_e( 'First name', 'woocommerce' ); ?>
                </span>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-input" name="first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" aria-required="true" />
                </label>
                <label class="form-label">
                <span class="form-title">
                    <?php esc_html_e( 'Last name', 'woocommerce' ); ?>
                </span>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-input" name="last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" aria-required="true" />
                </label>
            </div>
            <div class="flex flex-col items-center gap-4">
                <label class="form-label">
                <span class="form-title">
                    <?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;
                </span>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-input" name="display_name" id="account_display_name" aria-describedby="account_display_name_description" value="<?php echo esc_attr( $user->display_name ); ?>" aria-required="true" />
                </label>
                <label class="form-label">
                <span class="form-title">
                    <?php esc_html_e( 'Email address', 'woocommerce' ); ?>
                </span>
                    <input type="email" class="woocommerce-Input woocommerce-Input--email input-text form-input" name="user_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" aria-required="true" />
                </label>
            </div>
            <div class="flex flex-col items-center gap-4 col-span-full lg:col-auto">
                <label class="form-label relative">
                    <span class="form-title">
                        <?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?>
                    </span>
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-input" name="password_current" id="password_current" autocomplete="off" />
                    <a class="absolute eye-link group/eye cursor-pointer bottom-[23px] right-[10px] translate-y-1/2 opacity-[0.5] data-[active=true]:opacity-[1]" data-active="false">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/icons/eye.svg" width="20x" height="20px" alt="eye">
                        <span class="absolute bottom-[10px] right-[0px] translate-y-1/2 w-5 h-[2px] rotate-[-45deg] bg-neutral-800 group-data-[active=true]/eye:hidden"></span>
                    </a>
                </label>
                <label class="form-label relative">
                    <span class="form-title">
                        <?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?>
                    </span>
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-input" name="password_new" id="password_2" autocomplete="off" />
                    <a class="absolute eye-link group/eye cursor-pointer bottom-[23px] right-[10px] translate-y-1/2 opacity-[0.5] data-[active=true]:opacity-[1]" data-active="false">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/icons/eye.svg" width="20x" height="20px" alt="eye">
                        <span class="absolute bottom-[10px] right-[0px] translate-y-1/2 w-5 h-[2px] rotate-[-45deg] bg-neutral-800 group-data-[active=true]/eye:hidden"></span>
                    </a>
                </label>
                <label class="form-label relative">
                    <span class="form-title">
                        <?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>
                    </span>
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-input" name="password_repeat" id="password_2" autocomplete="off" />
                    <a class="absolute eye-link group/eye cursor-pointer bottom-[23px] right-[10px] translate-y-1/2 opacity-[0.5] data-[active=true]:opacity-[1]" data-active="false">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/icons/eye.svg" width="20x" height="20px" alt="eye">
                        <span class="absolute bottom-[10px] right-[0px] translate-y-1/2 w-5 h-[2px] rotate-[-45deg] bg-neutral-800 group-data-[active=true]/eye:hidden"></span>
                    </a>
                </label>
            </div>
        </div>
        <p>
            <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <button type="submit" class="mx-auto max-w-[300px] w-full mt-4 flex items-center justify-center h-10 mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800"
                    name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
        </p>

        <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </form>
