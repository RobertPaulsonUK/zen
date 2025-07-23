<?php
    /**
     * My Orders - Deprecated
     *
     * @deprecated 2.6.0 this template file is no longer used. My Account shortcode uses orders.php.
     * @package WooCommerce\Templates
     */

    defined( 'ABSPATH' ) || exit;

    $my_orders_columns = apply_filters(
        'woocommerce_my_account_my_orders_columns',
        array(
            'order-number'  => esc_html__( 'Order', 'woocommerce' ),
            'order-date'    => esc_html__( 'Date', 'woocommerce' ),
            'order-status'  => esc_html__( 'Status', 'woocommerce' ),
            'order-total'   => esc_html__( 'Total', 'woocommerce' ),
            'order-actions' => '&nbsp;',
        )
    );

    $customer_orders = wc_get_orders( array(
        'customer_id' => get_current_user_id(),
        'limit'       => 10,
        'orderby'     => 'date',
        'order'       => 'DESC',
    ) );
    $statuses_color_classes = [
        'completed' => 'text-green-600',
        'processing' => 'text-yellow-500',
        'canceled' => 'text-red-600',
        'failed' => 'text-red-600',
    ];
    if ( $customer_orders ) : ?>
        <div class="py-4 px-3 rounded-xl border-[3px] border-neutral-800/20 text-neutral-800 overflow-x-scroll">
            <table class="w-full table-fixed border-collapse text-sm min-w-[500px]">
                <thead>
                    <tr class="border-b-[2px] border-neutral-800/20">
                        <?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
                            <th class="text-left font-bold py-4">
                                <?php echo esc_html( $column_name ); ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ( $customer_orders as $index => $customer_order ) :
                        $order      = wc_get_order( $customer_order );
                        $item_count = $order->get_item_count();
                        ?>
                        <tr class="border-b-[2px] border-neutral-800/20">
                            <?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
                                <td class="py-4" data-title="<?php echo esc_attr( $column_name ); ?>">
                                    <?php if ( 'order-number' === $column_id ) : ?>
                                        <?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>

                                    <?php elseif ( 'order-date' === $column_id ) : ?>
                                        <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

                                    <?php elseif ( 'order-status' === $column_id ) :
                                        $status = $order->get_status();
                                        $color_class = $statuses_color_classes[$status] ?? 'text-neutral-800';
                                        ?>
                                        <span class="w-full text-left <?= esc_attr($color_class) ?>">
                                            <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
                                        </span>

                                    <?php elseif ( 'order-total' === $column_id ) : ?>
                                        <?php
                                        /* translators: 1: formatted order total 2: total order items */
                                        printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        ?>

                                    <?php elseif ( 'order-actions' === $column_id ) : ?>
                                        <a href="#" class="view-order-link text-green-600 relative p-2 group"
                                           data-order-id="<?= esc_attr($order->get_order_number()) ?>">
                                            <?php esc_html_e('View','robert-theme'); ?>
                                            <span class="block w-[0] absolute left-1/2 -translate-x-1/2 h-[1px] bg-green-600 rounded-xs transition-[width] duration-200 easy-linear group-hover:w-full"></span>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div id="order-view-modal" class="fixed inset-0 bg-neutral-800/50 z-302 flex justify-center items-center hidden modal-overlay">
            <div class="fixed inset-0 backdrop-blur-xs z-303 flex items-center justify-center cursor-pointer modal-close-overlay">
                <div class="p-7 rounded border-2 border-neutral-800 bg-white-900 text-center text-neutral-800 text-base cursor-default max-h-[90vh] overflow-y-auto relative modal-body">
                    <button class="w-5 h-5 cursor-pointer absolute top-2 right-2 modal-close-btn" type="button">
                        <span class="block w-full bg-neutral-800 h-[2px] rotate-[45deg]"></span>
                        <span class="block w-full bg-neutral-800 h-[2px] -rotate-[45deg] mt-[-2px]"></span>
                    </button>
                    <div id="order-view-container">
                        <!-- ajax order output-->
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="py-4 px-3 rounded-xl border-[3px] border-neutral-800/20 text-neutral-800 uppercase font-semibold text-center">
            <?php esc_html_e("You don't have any orders yet.",'robert-theme'); ?>
            <a href="<?= esc_url(get_permalink( wc_get_page_id( 'shop' ) )) ?>"
               class="mx-auto max-w-[300px] w-full mt-4 flex items-center justify-center h-10 mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800">
                <?= __('To shop','robert-theme') ?>
            </a>
        </div>
    <?php endif; ?>