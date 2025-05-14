<?php
    /**
     * Single Product Image
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.7.0
     */

    use Automattic\WooCommerce\Enums\ProductType;

    defined( 'ABSPATH' ) || exit;

    // Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
    if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
        return;
    }

    global $product;

    $product_name = $product->get_name();
    $wrapper_classes   = apply_filters(
        'woocommerce_single_product_image_gallery_classes',
        'mySwiper overflow-x-hidden'
    );
    $images_src = get_product_image_gallery_urls($product);
?>
    <div class="md:max-w-[calc(50%-30px)] w-full grow-1">
        <div id="single-product-slider" class="<?php echo esc_attr($wrapper_classes ); ?>">
            <div class="swiper-wrapper">
                <?php foreach ($images_src as $index => $src):
                    $alt = $index !== 0 ? sprintf('%s - image %d of %d',$product_name,$index + 1,count($images_src)) : $product_name;
                    ?>
                    <div class="swiper-slide w-full">
                        <img src="<?= esc_url($src) ?>"
                             height="511px"
                             width="390px"
                             class="h-[511px] w-full object-cover lg:min-h-[700px]"
                             title="<?= esc_attr($alt) ?>"
                             alt="<?= esc_attr($alt) ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php do_action( 'woocommerce_product_thumbnails' ); ?>
    </div>