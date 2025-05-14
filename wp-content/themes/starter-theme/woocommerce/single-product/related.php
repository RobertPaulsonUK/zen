<?php
    /**
     * Related Products
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see         https://woocommerce.com/document/template-structure/
     * @package     WooCommerce\Templates
     * @version     9.6.0
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( $related_products ) : ?>

        <section class="related py-section md:py-section-desktop">
            <div class="container mx-auto px-4">
                <?php
                    $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Similar Items', 'woocommerce' ) );

                    if ( $heading ) :
                        ?>
                        <h2 class="<?= esc_attr(heading_classes()) ?>"><?php echo esc_html( $heading ); ?></h2>
                    <?php endif; ?>
                <ul class="grid mt-8 grid-cols-2 gap-x-4 gap-y-8 lg:grid-cols-4 h-fit">

                <?php foreach ( $related_products as $related_product ) : ?>

                    <?php
                    $post_object = get_post( $related_product->get_id() );

                    setup_postdata( $GLOBALS['post'] = $post_object );

                    get_template_part( 'template-parts/loop/content', 'product' );
                    ?>

                <?php endforeach; ?>

                </ul>
            </div>
        </section>
    <?php
    endif;

    wp_reset_postdata();