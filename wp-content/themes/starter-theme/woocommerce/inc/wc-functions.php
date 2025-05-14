<?php
    require get_template_directory() . '/woocommerce/inc/wc-archive-functions.php';
    require get_template_directory() . '/woocommerce/inc/wc-single-functions.php';
    require get_template_directory() . '/woocommerce/inc/wishlist-functions.php';
    require get_template_directory() . '/woocommerce/inc/WooWishlistClass.php';
    require get_template_directory() . '/woocommerce/inc/ajax-add-to-cart.php';
    require get_template_directory() . '/woocommerce/inc/filter-functions.php';
    require get_template_directory() . '/woocommerce/inc/wc-redirects.php';
    require get_template_directory() . '/woocommerce/inc/color-product-meta.php';
    require get_template_directory() . '/woocommerce/inc/ajax-update-cart-item.php';
    require get_template_directory() . '/woocommerce/inc/ajax-search.php';

    function print_single_product_price( WC_Product $product,string $text_class = 'text-sm'):void
    {
        $sale_price = $product->get_sale_price();
        ?>
        <div class="flex gap-2 items-center text-sm font-semibold text-[#3A3845] <?= esc_attr($text_class) ?>">
            <?php if($sale_price > 0):?>
                    <span>
                        <?= wc_price($sale_price) ?>
                    </span>
                    <span class="line-through opacity-[0.7] -translate-y-1/4">
                        <?= wc_price($product->get_regular_price()) ?>
                    </span>
            <?php else: ?>
                <span>
                    <?= wc_price($product->get_regular_price()) ?>
                </span>
            <?php endif; ?>
        </div>
    <?php
    }

    function print_variable_product_price( WC_Product $product, string $text_class = 'text-sm'):void
    {
        $variations = $product->get_available_variations();
        $prices = [];

        foreach ( $variations as $variation ) {
            $price = isset( $variation['display_price'] ) ? $variation['display_price'] : 0;
            if ( $price ) {
                $prices[] = $price;
            }
        }

        $min_price = !empty($prices) ? min($prices) : 0;
        $max_price = !empty($prices) ? max($prices) : 0;
        $output = $min_price === $max_price ? $min_price : $min_price . ' - ' . $max_price;
        ?>
        <div class="flex gap-2 items-center text-sm font-semibold text-[#3A3845] <?= esc_attr($text_class) ?>">
            <?php if($min_price === $max_price): ?>
                <span>
                    <?= wc_price($min_price) ?>
                </span>
            <?php else:?>
                <span>
                    <?= wc_price($min_price) ?>
                </span>
                <span>
                    -
                </span>
                <span>
                     <?= wc_price($max_price) ?>
                </span>
            <?php endif; ?>

        </div>
        <?php
    }

    add_action('woocommerce_before_add_to_cart_quantity','add_form_qty_hidden_wrapper',10);
    function add_form_qty_hidden_wrapper()
    {
        if(!is_singular('product')) {
            echo '<div class="hidden">';
        }
    }

    add_action('woocommerce_after_add_to_cart_quantity','close_form_qty_hidden_wrapper',50);
    function close_form_qty_hidden_wrapper()
    {
        if(!is_singular('product')) {
            echo '</div>';
        }
    }
    /**
     * Remove default WooCommerce wrapper.
     */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

    if ( ! function_exists( 'robert_theme_woocommerce_wrapper_before' ) ) {
        /**
         * Before Content.
         *
         * Wraps all WooCommerce content in wrappers which match the theme markup.
         *
         * @return void
         */
        function robert_theme_woocommerce_wrapper_before() {
            ?>
            <main id="primary" class="main">
            <?php
        }
    }
    add_action( 'woocommerce_before_main_content', 'robert_theme_woocommerce_wrapper_before' ,10);

    if ( ! function_exists( 'robert_theme_woocommerce_wrapper_after' ) ) {
        /**
         * After Content.
         *
         * Closes the wrapping divs.
         *
         * @return void
         */
        function robert_theme_woocommerce_wrapper_after() {
            ?>
            </main><!-- #main -->
            <?php
        }
    }
    add_action( 'woocommerce_after_main_content', 'robert_theme_woocommerce_wrapper_after' ,50);
    /**
     * Related Products Args.
     *
     * @param array $args related products args.
     * @return array $args related products args.
     */
    function robert_theme_woocommerce_related_products_args( $args ) {
        $defaults = array(
            'posts_per_page' => 4,
            'columns'        => 4,
        );

        $args = wp_parse_args( $defaults, $args );

        return $args;
    }
    add_filter( 'woocommerce_output_related_products_args', 'robert_theme_woocommerce_related_products_args' );


    function get_product_image_gallery_urls(WC_Product $product,string $size = 'full'):array {
        $image_id = $product->get_image_id();
        $image_url = $image_id ? wp_get_attachment_image_src($image_id,$size)[0] : wc_placeholder_img_src( 'woocommerce_single' );
        $gallery_ids = $product->get_gallery_image_ids();
        if(!empty($gallery_ids)) {
            $gallery_images_src = array_map(function ($id) use($size) {
                return wp_get_attachment_image_src($id,$size)[0];
            },$gallery_ids);
        } else {
            $gallery_images_src = [];
        }
        return array_merge(array($image_url),$gallery_images_src);
    }
    add_action('woocommerce_after_main_content','print_recent_viewed_product',5);
    function print_recent_viewed_product() {
        if(!is_product() && !is_shop() && !is_category()) {
            return;
        }
        $viewed_products_ids = isset( $_COOKIE['viewed_products'] ) ? explode( ',', $_COOKIE['viewed_products'] ) : array();
        if(empty($viewed_products_ids)) {
            return;
        }
        $products = wc_get_products( array(
            'include' => $viewed_products_ids,
            'limit'   => -1,
        ) );
        ?>
        <section class="py-section md:py-section-desktop">
            <div class="container px-4 mx-auto">
                <h2 class="<?= esc_attr(heading_classes()) ?>">
                    <?php esc_html_e('Recent viewed products','robert-theme'); ?>
                </h2>
                <div id="recent-viewed-slider"
                     class="mySwiper overflow-x-hidden mt-8 relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($products as $product) {
                            $post_object = get_post( $product->get_id() );
                            setup_postdata( $post_object );
                            get_template_part('template-parts/loop/content','product',['is_slider' => true]);
                        }
                            wp_reset_postdata();
                        ?>
                    </div>
                    <div class="flex items-center justify-center gap-5 mt-5">
                        <button type="button" class="cursor-pointer p-2 rounded-full border border-neutral-800 button-prev">
                            <img width="16px" height="24px" class="rotate-[180deg]" src="<?= get_template_directory_uri() ?>/assets/images/icons/arrow-right-black.svg" alt="arrow-right">
                        </button>
                        <button type="button" class="cursor-pointer p-2 rounded-full border border-neutral-800 button-next">
                            <img width="16px" height="24px" src="<?= get_template_directory_uri() ?>/assets/images/icons/arrow-right-black.svg" alt="arrow-right">
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
