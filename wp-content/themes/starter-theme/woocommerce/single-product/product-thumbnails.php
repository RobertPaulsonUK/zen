<?php
    /**
     * Single Product Thumbnails
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see         https://woocommerce.com/document/template-structure/
     * @package     WooCommerce\Templates
     * @version     9.8.0
     */

    defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
    if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
        return;
    }

    global $product;

    if ( ! $product || ! $product instanceof WC_Product ) {
        return '';
    }
    $thumbnails_src = get_product_image_gallery_urls($product,'thumbnail');
    if(empty($thumbnails_src)) {
        return;
    }
    ?>
    <div id="single-thumbnails-slider"
         class="mySwiper overflow-x-hidden w-full mt-5">
        <div class="swiper-wrapper">
            <?php foreach ($thumbnails_src as $index => $src):
                $alt = 'thumbnail - ' . $index + 1;
                ?>
                <div class="swiper-slide w-[100px] h-[100px] group cursor-pointer">
                    <img src="<?= esc_url($src) ?>"
                         height="100px"
                         width="100px"
                         class="shrink-0 object-cover w-full h-full max-w-[136px] grayscale border border-transparent group-[.swiper-slide-thumb-active]:grayscale-0 group-[.swiper-slide-thumb-active]:border-neutral-800"
                         title="<?= esc_attr($alt) ?>"
                         alt="<?= esc_attr($alt) ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
