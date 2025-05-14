<?php
    /**
     * Single Product tabs
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.8.0
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    /**
     * Filter tabs and allow third parties to add their own.
     *
     * Each tab is an array containing title, callback and priority.
     *
     * @see woocommerce_default_product_tabs()
     */

    $product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
    if ( ! empty( $product_tabs ) ) :
        $product_tabs['description']['title'] = __('Details','robert-theme');
        $product_tabs['additional_information']['title'] = __('Dimensions','robert-theme');
        $product_tabs['additional_information']['callback'] = 'robert_custom_additional_information';
        ?>
        <div class="mt-8">
            <ul class="accordion border-t border-neutral-400">
                <?php foreach ($product_tabs as $key => $product_tab):
                    $title = $product_tab['title'];
                    $callback = $product_tab['callback'];
                    ?>
                    <li data-open="false"
                        class="accordion-item group py-6 border-b border-neutral-400">
                        <button class="accordion-button cursor-pointer w-full flex justify-between items-center text-lg font-semibold text-neutral-800">
                            <?= esc_html($title) ?>
                            <span class="flex flex-col w-4">
                                <span class="block w-full h-[2px] bg-neutral-800"></span>
                                <span class="block w-full h-[2px] bg-neutral-800 mt-[-2px] rotate-[90deg] transition-rotate duration-300 linear group-data-[open=true]:rotate-[0deg]"></span>
                            </span>
                        </button>
                        <div class="accordion-dropdown pt-3 hidden text-block max-h-0 transition-[max-height] duration-300 linear overflow-hidden">
                            <?php if($callback) {
                                call_user_func( $callback, $key, $product_tab );
                            } ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;