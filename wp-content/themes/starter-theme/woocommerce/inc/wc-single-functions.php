<?php
    remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
    add_action('woocommerce_before_single_product_summary','robert_add_single_product_wrapper',5);
    function robert_add_single_product_wrapper()
    {
        echo '<div class="flex flex-col md:flex-row gap-10 md:gap-15">';
    }
    remove_all_actions('woocommerce_after_single_product_summary');
    add_action('woocommerce_after_single_product_summary','robert_close_single_product_wrapper',10);
    function robert_close_single_product_wrapper()
    {
        echo '</div>';
    }
    add_action('woocommerce_before_single_product_summary','robert_add_product_summary_wrapper',50);
    function robert_add_product_summary_wrapper()
    {
        echo '<div class="md:max-w-[calc(50%-30px)] w-full grow-1">';
    }
    add_action('woocommerce_single_product_summary',function () {
        echo '</div>';
    },100);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
    add_action('woocommerce_single_product_summary','robert_template_single_title',5);
    function robert_template_single_title():void
    {
        global $product;

        echo '<h1 class="text-xl text-neutral-800 uppercase font-semibold">' . esc_html($product->get_name()) . '</h1>';
    }
    add_action('woocommerce_single_product_summary',function () {
        echo '<div class="flex mt-5 items-center gap-x-10 gap-y-2 flex-wrap">';
    },7);
    add_action('woocommerce_single_product_summary',function () {
        global $product;
        $is_in_stock = $product->is_in_stock();
        ?>
            <p class="text-base text-neutral-800">
                <?= __('Stock:','robert-theme') ?>
                <span class="<?= $is_in_stock ? 'text-[#C69B7B]' : 'text-red' ?>">
                    <?= $is_in_stock ? __('In stock','robert-theme') : __('Out of stock','robert-theme') ?>
                </span>
            </p>
        <?php
    },13);
    add_action('woocommerce_single_product_summary',function () {
        echo '</div>';
    },15);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_price',17);
    add_filter('woocommerce_product_price_class','robert_change_price_wrapper_class',1,10);
    function robert_change_price_wrapper_class($price)
    {
        return 'mt-5 product-price flex flex-row-reverse justify-end gap-2 items-center text-2xl font-semibold text-[#3A3845]';
    }
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
    add_action('woocommerce_single_product_summary','robert_add_simple_color_attribute',20);
    function robert_add_simple_color_attribute()
    {
        global $product;
        if($product->get_type() !== 'simple') {
            return;
        }
        $color_attribute = $product->get_attributes()['pa_color'];
        $option_id = $color_attribute ? $color_attribute['options'][0] : null;
        $css_color_value = get_term_meta($option_id, 'option_css_value', true);
        ?>
        <div class="mt-8 text-base text-neutral-800">
            <div class="flex gap-2 items-center">
                <span>
                    <?php esc_html_e('Color :','robert-theme'); ?>
                </span>
                <span>
                    <?= esc_html($product->get_attribute('pa_color')) ?>
                </span>
            </div>
            <span class="w-9 h-9 block mt-3 border-[2px] border-white-900 outline" style="background: <?= $css_color_value ?>">
            </span>
        </div>
        <?php
    }
    add_action('woocommerce_before_quantity_input_field','robert_add_wrapper_and_button_to_qty',10);
    function robert_add_wrapper_and_button_to_qty():void
    {
        ?>
        <div class="flex qty-wrapper min-h-10 items-center border border-neutral-800 max-w-[130px] w-full justify-between">
            <button type="button" class="minus-btn p-3 cursor-pointer">
                <span class="block w-[10px] h-[1px] bg-neutral-800"></span>
            </button>
    <?php
    }
    add_action('woocommerce_after_quantity_input_field','robert_close_wrapper_and_button_to_qty',10);
    function robert_close_wrapper_and_button_to_qty():void
    {
        ?>
        <button type="button" class="plus-btn p-3 cursor-pointer">
            <span class="block w-[10px] h-[1px] bg-neutral-800"></span>
            <span class="block w-[10px] h-[1px] bg-neutral-800 rotate-[90deg] mt-[-1px]"></span>
        </button>
        </div>
        <?php
    }
    add_filter('woocommerce_quantity_input_classes','robert_change_qty_input_classes',2,10);
    function robert_change_qty_input_classes($classes,$product)
    {
        $classes[] = 'outline-0 w-fit text-center w-full pointer-events-none';
        return $classes;
    }
    add_action('woocommerce_after_add_to_cart_button','robert_custom_buttons_add_on_single_page',20);
    function robert_custom_buttons_add_on_single_page()
    {
        if(!is_product()) {
            return;
        }
    }
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
    add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs',55);
    add_filter('woocommerce_product_description_heading',function ($heading){
        return null;
    },1,10);
    add_filter('woocommerce_product_additional_information_heading',function ($heading){
        return null;
    },1,10);
    function robert_custom_additional_information($key, $product_tab )
    {
        global $product;
        $weight_unit = get_option('woocommerce_weight_unit');
        $dimension_unit = get_option('woocommerce_dimension_unit');
        $dimensions = [
            [
                'title' => __('Height','robert-theme'),
                'value' => $product->get_height() . ' ' . $dimension_unit
            ],
            [
                'title' => __('Length','robert-theme'),
                'value' => $product->get_length() . ' ' . $dimension_unit
            ],
            [
                'title' => __('Width','robert-theme'),
                'value' => $product->get_width() . ' ' . $dimension_unit
            ],
            [
                'title' => __('Weight','robert-theme'),
                'value' => $product->get_weight() . ' ' . $weight_unit
            ]
        ];
        ?>
        <div class="flex flex-col w-full">
            <?php foreach ($dimensions as $dimension): ?>
                <div class="py-2 flex items-center justify-between text-neutral-800">
                        <span>
                            <?= esc_html($dimension['title']) ?>
                        </span>
                    <span>
                            <?= esc_html($dimension['value']) ?>
                        </span>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
    remove_all_actions('woocommerce_review_before');
    remove_action('woocommerce_review_before_comment_meta','woocommerce_review_display_rating',10);
    add_action('woocommerce_review_before_comment_text','woocommerce_review_display_rating',10);
    add_action('woocommerce_after_single_product',function () {
        echo '</div>';
        echo '</section>';
    },10);
    add_action('woocommerce_after_single_product','woocommerce_output_related_products',50);
    add_action('woocommerce_after_add_to_cart_button','robert_add_custom_buttons',20);

    function robert_add_custom_buttons()
    {
        if(!is_product()) {
            return;
        }
        global $product;
        $is_disabled = $product->is_in_stock();
        $dop_class = $product->get_type() === 'variable' ? 'group-[.woocommerce-variation-add-to-cart-disabled]/variation:opacity-[0.3] group-[.woocommerce-variation-add-to-cart-disabled]/variation:pointer-events-none' : '';
        if($product->get_type() === 'simple') {
            $dop_class = $is_disabled ? '' : 'disabled';
        }
        ?>
        <div class="flex gap-3 items-center mt-5 additional-buttons">
            <button data-href="<?= esc_url(wc_get_checkout_url()) ?>"
                    value="<?= esc_attr($product->get_id()) ?>"
                    class="buy-one-click-button group/button text-sm border border-neutral-800 cursor-pointer font-semibold uppercase text-white-900 flex h-12 items-center justify-center px-4 w-full bg-neutral-800 one-click-button transition-colors duration-300 linear hover:bg-white-900 hover:text-neutral-800 <?= esc_attr($dop_class) ?>">
                <span class="static-text group-[.hold]/button:hidden">
                    <?php esc_html_e('Buy now'); ?>
                </span>
                <span data-text="<?php esc_html_e('Adding...','robert-theme'); ?>"
                      class="active-text initial-black text-white-900/0 relative hidden group-[.hold]/button:block">
                    <?php esc_html_e('Adding...','robert-theme'); ?>
                </span>
            </button>
            <?php get_template_part('components/woo/single-product','wish-button') ?>
        </div>
    <?php
    }
    add_action( 'template_redirect', 'track_viewed_products_cookie' );
    function track_viewed_products_cookie() {
        if ( ! is_product() ) return;

        global $post;
        if ( ! $post instanceof WP_Post ) return;

        $product_id = $post->ID;

        $viewed_products = isset( $_COOKIE['viewed_products'] ) ? explode( ',', $_COOKIE['viewed_products'] ) : array();

        if ( in_array( $product_id, $viewed_products ) ) {
            $key = array_search( $product_id, $viewed_products );
            if ( false !== $key ) {
                unset( $viewed_products[ $key ] );
            }
        }

        $viewed_products[] = $product_id;
        $viewed_products = array_slice( $viewed_products, -6 );

        setcookie(
            'viewed_products',
            implode( ',', $viewed_products ),
            time() + WEEK_IN_SECONDS,
            COOKIEPATH,
            COOKIE_DOMAIN
        );
    }
