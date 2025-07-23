<?php
    $product_id = $args['product_id'] ?? null;
    $is_last = $args['is_last'] ?? false;
    if(!$product_id) {
        return;
    }
    $product = wc_get_product($product_id);
    $name = $product->get_name();
    $id = $product->get_id();
    $image_id = $product->get_image_id();
    $image_url = $image_id ? wp_get_attachment_image_src($image_id,'medium')[0] : wc_placeholder_img_src( 'woocommerce_single' );
    $description = $product->get_short_description() ?? $product->get_description();
    $description = wp_trim_words($description,12,'...');
    $permalink = $product->get_permalink();
    $type = $product->get_type();
    ?>
    <div class="account-wishlist-item <?= !$is_last ? 'border-b-[2px] border-neutral-800/20' : '' ?> xl:px-10">
        <div class="flex gap-4">
            <div class="py-4 max-w-40 w-full shrink-0">
                <a href="<?= esc_url($permalink) ?>">
                    <img src="<?= $image_url ?>"
                         class="w-40 max-h-40 object-cover transition-[filter] duration-300 linear hover-hover:grayscale-50 hover:grayscale-0"
                         title="<?= esc_attr($name) ?>"
                         height="160px"
                         width="160px"
                         alt="<?= esc_attr($name) ?>">
                </a>
            </div>
            <div class="flex w-full flex-col ga-4 sm:flex-row sm:items-center sm:gap-4">
                <div class="py-4 text-center sm:w-full sm:max-w-1/2 lg:text-left lg:max-w-full lg:grow-1">
                    <a href="<?= esc_url($permalink) ?>">
                        <h4 class="text-sm font-semibold text-[#3A3845] uppercase">
                            <?= esc_html(wp_trim_words($name,6,'')) ?>
                        </h4>
                    </a>
                    <div class="hidden py-4 text-sm text-neutral-600 lg:block w-full">
                        <p>
                            <?= esc_html($description) ?>
                        </p>
                    </div>
                </div>
                <div class="py-4 text-center lg:w-[100px]">
                    <?php if($type === 'simple') {
                        print_single_product_price($product,'w-fit mx-auto');
                    } elseif($type === 'variable') {
                        print_variable_product_price($product,'w-fit mx-auto');
                    }?>
                </div>
                <?php get_template_part('components/woo/loop-account-wish','button',['product_id' => $product_id]); ?>
            </div>
        </div>
        <div class="py-4 text-sm text-neutral-600 text-center lg:hidden">
            <p>
                <?= esc_html($description) ?>
            </p>
        </div>
    </div>
