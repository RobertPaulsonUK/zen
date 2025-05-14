<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package robert_theme
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function robert_theme_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
}
add_action( 'after_setup_theme', 'robert_theme_woocommerce_setup' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function robert_theme_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'robert_theme_woocommerce_active_body_class' );

add_filter( 'woocommerce_add_to_cart_fragments', 'custom_cart_count_fragment' );

function custom_cart_count_fragment( $fragments ) {
    ob_start(); ?>
    <span id="cart-count" class="absolute block top-[-4px] right-[-4px] text-[8px] w-fit py-[1px] px-[4px] rounded-full bg-neutral-800 text-white-900">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $html = ob_get_clean();
    $fragments['span#cart-count'] = $html;

    return $fragments;
}
function custom_modal_cart_fragments($fragments) {
    ob_start();
    ?>
    <div class="widget_shopping_cart_content">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $html = ob_get_clean();
    $fragments['.widget_shopping_cart_content'] = $html;

    return $fragments;
}

