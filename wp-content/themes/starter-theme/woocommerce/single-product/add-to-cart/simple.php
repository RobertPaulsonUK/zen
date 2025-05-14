<?php
    /**
     * Simple product add to cart
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 7.0.1
     */

    defined( 'ABSPATH' ) || exit;

    global $product;

    if ( ! $product->is_purchasable() ) {
        return;
    }

    echo wc_get_stock_html( $product ); // WPCS: XSS ok.

    if ( $product->is_in_stock() ) : ?>

        <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

        <form class="cart w-full <?= is_product() ? 'my-8' : '' ?>" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
            <div class="flex gap-3 items-center mt-5 <?= $product->is_in_stock() ? '' : 'disabled' ?>">
            <?php
                do_action( 'woocommerce_before_add_to_cart_quantity' );

                woocommerce_quantity_input(
                    array(
                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    )
                );

                do_action( 'woocommerce_after_add_to_cart_quantity' );
            ?>
            <?php $button_classes = 'w-full group/button relative flex items-center justify-center h-[40px] cursor-pointer text-sm font-semibold uppercase py-[15px] px-[18px] text-center text-neutral-800 border border-neutral-800 transition-colors duration-300 linear hover:bg-neutral-800 hover:text-white-900'; ?>
            <button type="submit"
                    name="add-to-cart"
                    value="<?php echo esc_attr( $product->get_id() ); ?>"
                    class="single_add_to_cart_button button alt <?= esc_attr(apply_filters('add_to_cart_button_classes',$button_classes )) ?>">
                <span class="static-text group-[.hold]/button:hidden">
                    <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                </span>
                <span data-text="<?php esc_html_e('Adding...','robert-theme'); ?>"
                        class="active-text initial-white text-white-900/0 relative hidden group-[.hold]/button:block">
                    <?php esc_html_e('Adding...','robert-theme'); ?>
                </span>
            </button>
            </div>
            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
        </form>

        <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

    <?php endif; ?>