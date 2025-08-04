<?php
    global $product;
    $name = $product->get_name();
    $id = $product->get_id();
    $image_id = $product->get_image_id();
    $image_url = $image_id ? wp_get_attachment_image_src($image_id,'medium')[0] : wc_placeholder_img_src( 'woocommerce_single' );
    $description = $product->get_short_description() ?? $product->get_description();
    $description = wp_trim_words($description,12,'...');
    $permalink = $product->get_permalink();
    $type = $product->get_type();
    $is_slider = $args['is_slider'] ?? false;
    ?>
    <div class="<?= $is_slider ? 'swiper-slide' : 'flex flex-col gap-2' ?>">
        <div class="w-full relative z-1">
            <a href="<?= esc_url($permalink) ?>">
                <img src="<?= $image_url ?>"
                     class="w-full h-full object-cover transition-[filter] duration-300 linear hover-hover:grayscale-50 hover:grayscale-0"
                     title="<?= esc_attr($name) ?>"
                     height="321px"
                     width="255px"
                     alt="<?= esc_attr($name) ?>">
            </a>
            <?php get_template_part('components/woo/loop-product','wish-button') ?>
        </div>
        <div class="grow-1 flex flex-col gap-[20px] <?= $is_slider ? 'mt-2' : '' ?>">
            <div>
                <a href="<?= esc_url($permalink) ?>">
                    <h4 class="text-sm font-semibold text-[#3A3845] uppercase">
                        <?= esc_html(wp_trim_words($name,6,'')) ?>
                    </h4>
                </a>
                <div class="mt-[10px]">
                    <?php if($type === 'simple') {
                        print_single_product_price($product);
                    } elseif($type === 'variable') {
                        print_variable_product_price($product);
                    }?>
                </div>
            </div>
            <div class="text-sm text-neutral-600">
                <p>
                    <?= esc_html($description) ?>
                </p>
            </div>
            <div class="flex items-end h-auto grow-1">
                <?php if($type === 'simple') {
                    woocommerce_simple_add_to_cart();
                } elseif($type === 'variable') {
                    ?>
                        <a href="<?= esc_url($permalink) ?>" class="w-full mt-5 block flex items-center justify-center h-[40px] cursor-pointer text-sm font-semibold uppercase py-[15px] px-[18px] text-center text-neutral-800 border border-neutral-800 transition-colors duration-300 linear hover:bg-neutral-800 hover:text-white-900">
                            <?php esc_html_e('Choose','robert-theme') ?>
                        </a>
                    <?php
                }?>
            </div>
        </div>
    </div>

