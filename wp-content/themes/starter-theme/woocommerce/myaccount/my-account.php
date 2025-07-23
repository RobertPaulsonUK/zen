<?php
    /**
     * My Account page
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.5.0
     */

    defined( 'ABSPATH' ) || exit;
    $tabs_args = [
        [
            'title' => __('Account details','robert-theme'),
            'id' => 'account',
            'template' => 'myaccount/form-edit-account.php'
        ],
        [
            'title' => __('Orders','robert-theme'),
            'id' => 'orders',
            'template' => 'myaccount/my-orders.php'
        ],
        [
            'title' => __('Addresses','robert-theme'),
            'id' => 'addresses',
            'template' => 'myaccount/form-edit-address.php'
        ],
        [
            'title' => __('Wish list','robert-theme'),
            'id' => 'wishlist',
            'template' => 'myaccount/my-wishlist.php'
        ]

    ];
    $active_tab = $_GET['tab'] ?? $tabs_args[0]['id'];
?>
    <?php get_template_part('components/woo/account/logout','link'); ?>
    <h1 class="<?= heading_classes() ?>">
        <?php esc_html_e('My account','robert-theme'); ?>
    </h1>
    <?php if(!empty($tabs_args)): ?>
        <div class="mt-10 md:mt-16 tab-wrapper">
            <div class="flex items-center justify-center flex-col md:flex-row gap-4 text-base font-semibold text-neutral-800">
                <?php foreach ($tabs_args as $arg){
                    $button_args = [
                        'title' => $arg['title'],
                        'id' => $arg['id'],
                        'is_active' => $arg['id'] === $active_tab
                    ];
                    get_template_part('components/woo/account/tab/tab','button',$button_args);
                } ?>
            </div>
            <div class="mt-10">
                <?php foreach ($tabs_args as $arg){
                    $content_args = [
                        'id' => $arg['id'],
                        'is_active' => $arg['id'] === $active_tab,
                        'template' => $arg['template']
                    ];
                    get_template_part('components/woo/account/tab/tab','content',$content_args);
                } ?>
            </div>
        </div>
    <?php endif; ?>
