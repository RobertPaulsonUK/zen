<?php
    $query_args = [
        'limit'   => 8,
        'orderby' => 'total_sales',
        'order'   => 'DESC',
    ];

    $bestsallers = wc_get_products($query_args);
    if(empty($bestsallers)) {
        return;
    }
    ?>
    <section class="py-section md:py-section-desktop">
        <div class="container mx-auto px-[16px]">
            <h2 class="<?= esc_attr(heading_classes()) ?>">
                <?php esc_html_e('Best sellers','robert-theme') ?>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-8 mt-[40px]">
                <?php foreach ($bestsallers as $product) {
                    $post_object = get_post($product->get_id());
                    setup_postdata($post_object);
                    get_template_part('template-parts/loop/content','product');
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
