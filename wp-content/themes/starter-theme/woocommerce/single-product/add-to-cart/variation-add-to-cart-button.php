<?php
    /**
     * Single variation cart button
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 7.0.1
     */

    defined( 'ABSPATH' ) || exit;

    global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button group/variation">
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>
    <div class="flex gap-3 items-center mt-5 group-[.woocommerce-variation-add-to-cart-disabled]/variation:opacity-[0.3] group-[.woocommerce-variation-add-to-cart-disabled]/variation:pointer-events-none">
        <?php woocommerce_quantity_input(
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

    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>