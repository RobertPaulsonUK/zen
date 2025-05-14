<?php
    /**
     * Variable product add to cart
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.6.0
     */

    defined( 'ABSPATH' ) || exit;

    global $product;

    $attribute_keys  = array_keys( $attributes );
    $variations_json = wp_json_encode( $available_variations );
    $variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
    do_action( 'woocommerce_before_add_to_cart_form' );
    ?>

    <form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
        <?php do_action( 'woocommerce_before_variations_form' ); ?>

        <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
            <p class="text-sm text-neutral-800">
                <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?>
            </p>
        <?php else : ?>

            <table class="variations" cellspacing="0" role="presentation">
                <tbody>
                <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                    <tr>
                        <td class="flex flex-col gap-4 mt-8">
                            <h4 class="text-neutral-800 text-base font-semibold">
                                <span>
                                    <?php echo wc_attribute_label( $attribute_name ); ?> :
                                </span>
                                <span id="label_attribute_<?= esc_html($attribute_name) ?>" class="text-[#C69B7B] capitalize">
                                    <?php esc_html_e('Choose variation','robert-theme'); ?>
                                </span>
                            </h4>
                            <div class="flex flex-wrap gap-6 items-center attribute-wrapper">
                                <?php if($attribute_name === 'pa_color'): ?>
                                    <?php foreach ($options as $index => $option):
                                            $term = get_term_by('slug', $option, $attribute_name);
                                            $css_color_value = get_term_meta($term->term_id, 'option_css_value', true);
                                            $id = sanitize_title( $attribute_name ) . '-' . sanitize_title( $option );
                                            ?>
                                        <label class="group cursor-pointer">
                                            <span style="background: <?php echo esc_attr($css_color_value); ?>"
                                                  class="w-9 h-9 block mt-3 border-[2px] border-white-900 group-has-checked:outline">
                                            </span>
                                            <input type="radio"
                                                   class="hidden"
                                                   id="<?= esc_attr($id) ?>"
                                                   <?= $index === 0 ? 'checked' : '' ?>
                                                   name="attribute_<?= esc_attr( sanitize_title( $attribute_name ) ) ?>"
                                                   value="<?= esc_attr($option) ?>">
                                        </label>
                                    <?php endforeach; ?>
                                <?php else:
                                    foreach ($options as $index => $option):
                                        $id = sanitize_title( $attribute_name ) . '-' . sanitize_title( $option );
                                        ?>
                                        <label class="group cursor-pointer">
                                                <span style="background: <?php echo esc_attr($css_color_value); ?>"
                                                      class="py-2 px-3 block text-base rounded border border-neutral-800 text-neutral-800 bg-white-900 transition-colors duration-200 linear group-has-checked:bg-neutral-800 group-has-checked:text-white-900">
                                                </span>
                                                <input type="radio"
                                                       class="hidden"
                                                        <?= $index === 0 ? 'checked' : '' ?>
                                                       id="<?= esc_attr($id) ?>"
                                                       name="attribute_<?= esc_attr( sanitize_title( $attribute_name ) ) ?>"
                                                       value="<?= esc_attr($option) ?>">
                                        </label>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div class="hidden native-select">
                                    <?php wc_dropdown_variation_attribute_options(
                                            array(
                                                'options'   => $options,
                                                'attribute' => $attribute_name,
                                                'product'   => $product,
                                                'selected' => $options[0]
                                            )
                                        ); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
            <?php do_action( 'woocommerce_after_variations_table' ); ?>

            <div class="single_variation_wrap">
                <?php
                    /**
                     * Hook: woocommerce_before_single_variation.
                     */
                    do_action( 'woocommerce_before_single_variation' );

                    /**
                     * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                     *
                     * @since 2.4.0
                     * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                     * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                     */
                    do_action( 'woocommerce_single_variation' );

                    /**
                     * Hook: woocommerce_after_single_variation.
                     */
                    do_action( 'woocommerce_after_single_variation' );
                ?>
            </div>
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_variations_form' ); ?>
    </form>

<?php
    do_action( 'woocommerce_after_add_to_cart_form' );