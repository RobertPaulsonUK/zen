<?php
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
    add_action('woocommerce_before_main_content',function () {
        get_template_part('components/global/woocommerce','breadcrumbs');
    },20);
    remove_all_actions('woocommerce_sidebar');
    add_action('woocommerce_before_main_content','robert_archive_wrapper_start',40);
    function robert_archive_wrapper_start()
    {
        echo '<section class="py-section md:py-section-desktop">';
        echo '<div class="container mx-auto px-4 overflow-x-hidden">';
    }
    add_action('woocommerce_after_main_content','robert_archive_wrapper_end',40);
    function robert_archive_wrapper_end()
    {
        echo '</div>';
        echo '</section>';
    }
    add_action('woocommerce_before_shop_loop','robert_archive_actions_wrapper_start',15);
    function robert_archive_actions_wrapper_start()
    {
        echo '<div class="flex justify-between items-center my-5">';
    }
    add_action('woocommerce_before_shop_loop','robert_archive_actions_wrapper_end',35);
    function robert_archive_actions_wrapper_end()
    {
        echo '</div>';
    }

    add_action('woocommerce_before_shop_loop','robert_start_prefilter_wrapper_start',40);
    add_action('woocommerce_before_shop_loop','robert_print_archive_filters',50);
    add_action('woocommerce_after_shop_loop','robert_start_prefilter_wrapper_end',5);
    function robert_start_prefilter_wrapper_start()
    {
        echo '<div class="flex flex-col gap-5 lg:flex-row">';
    }
    function robert_start_prefilter_wrapper_end()
    {
        echo '</div>';
    }
    function robert_print_archive_filters()
    {
        get_template_part('components/global/filters');
    }
    remove_all_actions('woocommerce_archive_description');
    remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
    add_action('woocommerce_before_shop_loop','robert_woocommerce_catalog_ordering',30);
    function robert_woocommerce_catalog_ordering()
    {
        get_template_part('components/global/archive','ordering-widget');
    }