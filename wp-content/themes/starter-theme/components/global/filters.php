<?php
    $product_categories =  get_terms( [
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
    ] );
    $product_tags =  get_terms( [
        'taxonomy'   => 'product_tag',
        'hide_empty' => true,
    ] );
    $prices = array(
        [
            'title' => '$0 - $10',
            'value' => '<10'
        ],
        [
            'title' => '$10 - $50',
            'value' => '>10 && <50'
        ],
        [
            'title' => '$100 - $200',
            'value' => '>100 && <200'
        ],
        [
            'title' => '> $200',
            'value' => '>200'
        ],
    );
    $colors = get_terms([
        'taxonomy' => 'pa_color',
        'hide_empty' => true,
    ]);

    ?>
    <div class="relative z-5">
        <button data-open="false"
                id="mobile-filter-button"
                class="group p-2 w-fit flex gap-2 items-center lg:hidden uppercase text-sm font-semibold text-neutral-800"
                type="button">
            <img src="<?= get_template_directory_uri() ?>/assets/images/icons/filter.svg" alt="filter-icon" class="transition-[rotate] duration-300 linear group-data-[open=true]:rotate-[180deg]">
            <?php esc_html_e("Filter",'robert-theme'); ?>
        </button>
        <div data-open="false"
             id="archive-filter"
             class="lg:max-w-[238px] bg-white-900 lg:bg-transparent border border-neutral-800 lg:border-transparent rounded p-6 lg:p-0 w-full absolute top-[120%] translate-x-[-120%] left-0 lg:static lg:translate-0 data-[open=true]:translate-x-[0] transition-transform duration-300 linear">
            <form method="GET">
                <?php if(is_shop() && !empty($product_categories)): ?>
                    <div class="lg:py-[30px] lg:lg:border-t lg:border-neutral-800">
                        <h4 class="text-neutral-800 text-sm font-semibold">
                            <?php esc_html_e('Categories','robert_theme'); ?>
                        </h4>
                        <div class="flex flex-col gap-4 items-start mt-5">
                            <?php foreach ($product_categories as $product_category){
                                $args = [
                                    'name' => 'categories',
                                    'value' => $product_category->term_id,
                                    'title' => $product_category->name
                                ];
                                get_template_part('components/global/form/filter','checkbox',$args);
                            } ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="py-5 lg:py-[30px] lg:border-t border-neutral-800">
                    <h4 class="text-neutral-800 text-sm font-semibold">
                        <?php esc_html_e('Price Range','robert_theme'); ?>
                    </h4>
                    <div class="flex flex-col gap-4 items-start mt-5">
                        <?php foreach ($prices as $price){
                            $args = [
                                'name' => 'prices',
                                'value' => $price['value'],
                                'title' => $price['title']
                            ];
                            get_template_part('components/global/form/filter','checkbox',$args);
                        } ?>
                    </div>
                </div>
                <?php if(!empty($colors)): ?>
                    <div class="py-5 lg:py-[30px] lg:border-t border-neutral-800">
                        <h4 class="text-neutral-800 text-sm font-semibold">
                            <?php esc_html_e('Color','robert_theme'); ?>
                        </h4>
                        <div class="flex gap-4 items-start mt-5">
                            <?php foreach ($colors as $color):
                                $id = $color->term_id;
                                $is_checked = isset($_GET['colors']) && in_array($id,$_GET['colors']);
                                $value = get_term_meta($id, 'option_css_value', true);
                                ?>
                                <label class="group cursor-pointer">
                                <span style="background: <?php echo esc_attr($value); ?>" class="block w-4 h-4 border lg:border-transparent group-has-checked:border-neutral-800 group-has-checked:scale-[1.2]">
                                <input type="checkbox"
                                       class="hidden"
                                    <?= $is_checked ? 'checked' : '' ?>
                                       name="colors[]"
                                       value="<?= esc_attr($id) ?>">
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($product_tags)): ?>
                    <div class="py-5 lg:py-[30px] lg:border-t border-neutral-800">
                        <h4 class="text-neutral-800 text-sm font-semibold">
                            <?php esc_html_e('Tags','robert_theme'); ?>
                        </h4>
                        <div class="flex flex-col gap-4 items-start mt-5">
                            <?php foreach ($product_tags as $product_tag){
                                $args = [
                                    'name' => 'tags',
                                    'value' => $product_tag->term_id,
                                    'title' => $product_tag->name
                                ];
                                get_template_part('components/global/form/filter','checkbox',$args);
                            } ?>
                        </div>
                    </div>
                <?php endif; ?>
                <a id="reset-filter-btn" class="w-full flex cursor-pointer bg-neutral-100 items-center justify-center h-[40px] text-sm font-semibold uppercase py-[15px] px-[18px] text-center text-neutral-800 border border-neutral-800 transition-colors duration-300 linear hover:bg-neutral-800 hover:text-white-900">
                    <?php esc_html_e('Clear','robert-theme'); ?>
                </a>
                <button class="w-full flex items-center justify-center h-[40px] mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800" type="submit">
                    <?php esc_html_e('Filter','robert-theme'); ?>
                </button>
            </form>
        </div>
    </div>
