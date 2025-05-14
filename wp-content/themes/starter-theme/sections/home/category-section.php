<?php
    $terms = get_terms( [
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
    ] );

    if (  empty( $terms ) ||  is_wp_error( $terms ) ) {
        return;
    }
    ?>
    <section class="py-section md:py-section-desktop">
        <div class="container px-[16px] mx-auto">
            <h2 class="<?= esc_attr(heading_classes()) ?>">
                <?php esc_html_e('Categories','robert-theme'); ?>
            </h2>
            <div id="category-slider" class="mySwiper overflow-x-hidden mt-[30px]">
                <div class="swiper-wrapper">
                    <?php foreach ($terms as $term) {
                        get_template_part('template-parts/loop/content','product-category',['term' => $term]);
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
