<?php
    /**
     * Mini-cart
     *
     * Contains the markup for the mini-cart, used by the cart widget.
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.4.0
     */

    defined( 'ABSPATH' ) || exit;

    do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>

    <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?> flex flex-col gap-4 max-h-[500px] h-full overflow-x-auto">
        <?php
            do_action( 'woocommerce_before_mini_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    /**
                     * This filter is documented in woocommerce/templates/cart/cart.php.
                     *
                     * @since 2.1.0
                     */
                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    $min_amount = $_product->get_min_purchase_quantity() ?? 1;
                    $max_amount = $_product->get_max_purchase_quantity() ?? 100;
                    ?>
                    <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <div class="flex gap-4">
                            <div class="shrink-0">
                                <?php if ( empty( $product_permalink ) ) : ?>
                                    <?php echo $thumbnail; ?>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                                        <?php echo $thumbnail; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="text-neutral-800 w-full">
                                <h4 class="text-base font-semibold">
                                    <?= wp_kses_post( $product_name ) ?>
                                </h4>
                                <span class="text-base font-semibold">
                                    <?= $product_price ?>
                                </span>
                                <div class="mt-4 flex items-center gap-2 justify-between">
                                    <div class="flex qty-wrapper min-h-10 items-center border border-neutral-800 max-w-[130px] w-full justify-between">
                                        <button type="button" class="cart-minus-btn p-3 cursor-pointer <?= $cart_item['quantity'] === $min_amount ? 'disabled' : '' ?>">
                                            <span class="block w-[10px] h-[1px] bg-neutral-800"></span>
                                        </button>
                                        <input type="number"
                                               data-cart-item-key="<?= esc_attr($cart_item_key) ?>"
                                               data-product-id="<?= esc_attr($_product->get_id()) ?>"
                                               class="input-text outline-0 w-fit text-center w-full pointer-events-none"
                                               name="quantity"
                                               value="<?= esc_attr($cart_item['quantity']) ?>"
                                               aria-label="Product quantity"
                                               min="<?= esc_attr($min_amount) ?>"
                                               max="<?= esc_attr($max_amount) ?>"
                                               step="1"
                                               placeholder=""
                                               inputmode="numeric"
                                               autocomplete="off">
                                        <button type="button" class="cart-plus-btn p-3 cursor-pointer <?= $cart_item['quantity'] === $max_amount ? 'disabled' : '' ?>">
                                            <span class="block w-[10px] h-[1px] bg-neutral-800"></span>
                                            <span class="block w-[10px] h-[1px] bg-neutral-800 rotate-[90deg] mt-[-1px]"></span>
                                        </button>
                                    </div>
                                    <button class="w-6 h-6 cursor-pointer cart-item-remove rounded-full p-1 border border-[#E54335]"
                                            data-cart-item-key="<?= esc_attr($cart_item_key) ?>"
                                            data-product-id="<?= esc_attr($_product->get_id()) ?>"
                                            type="button">
                                        <span class="block w-full bg-[#E54335] h-[2px] rotate-[45deg]"></span>
                                        <span class="block w-full bg-[#E54335] h-[2px] -rotate-[45deg] mt-[-2px]"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </li>
                    <?php
                }
            }

            do_action( 'woocommerce_mini_cart_contents' );
        ?>
    </ul>
    <div>
        <div class="text-neutral-800 text-lg flex flex-col gap-4 border-t border-neutral-800 py-4">
            <div class="flex items-center justify-between">
                <?= sprintf('<strong>%s</strong><span>%s</span>',__('Total items','robert-theme'),WC()->cart->get_cart_contents_count()) ?>
            </div>
            <div class="flex items-center justify-between">
                <?= sprintf('<strong>%s</strong><span>%s</span>',__('Subtotal','robert-theme'),WC()->cart->get_cart_subtotal()) ?>
            </div>
        </div>
        <div class="">
            <a href="<?= esc_url(wc_get_checkout_url()) ?>" class="w-full flex items-center justify-center h-[40px] mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800">
                <?php esc_html_e('Order','robert-theme'); ?>
            </a>
        </div>
    </div>

<?php else : ?>

    <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>