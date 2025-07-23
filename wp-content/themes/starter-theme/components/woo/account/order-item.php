<?php
    $order_id = $args['order_id'] ?? 0;
    $order = wc_get_order($order_id);
    if(!$order || ($order->get_user_id() !== get_current_user_id())) {
        ?>
        <div class="text-lg text-center text-neutral-800">
            <?php esc_html_e('Oops, something went wrong! Try again','robert-theme'); ?>
        </div>
        <?php
        return;
    }
    $order_items = $order->get_items();
    ?>
    <div class="w-75 md:w-100">
        <h3 class="text-xl text-center font-bold font-garamond text-neutral-800">
            <?= sprintf('%s № %d',__('Order','robert-theme'),$order_id) ?>
        </h3>
        <div class="w-full flex-col gap-3 text-lg mt-5">
            <div class="flex justify-between items-center">
                <span>
                    <?= esc_html__( 'Date', 'woocommerce' ) ?>
                </span>
                <span>
                    <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span>
                    <?= esc_html__( 'Status', 'woocommerce' ) ?>
                </span>
                <span>
                    <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span>
                    <?= esc_html__( 'Total', 'woocommerce' ) ?>
                </span>
                <span>
                    <?= $order->get_formatted_order_total() ?>
                </span>
            </div>
        </div>
        <div class="mt-5">
            <h3 class="text-xl text-center font-bold font-garamond text-neutral-800">
                <?php esc_html_e('Order items:','robert-theme'); ?>
            </h3>
            <ul class="w-full flex flex-col gap-2">
                <?php foreach ($order_items as $order_item){
                    get_template_part('components/woo/loop-order-item','preview',['order_item' => $order_item]);
                }
                ?>
            </ul>
        </div>
        <div class="mt-5">
            <h3 class="text-xl text-center font-bold font-garamond text-neutral-800">
                <?php esc_html_e('Delivery details:','robert-theme'); ?>
            </h3>
            <div class="text-lg text-center mt-4">
                <?= wp_kses_post($order->get_formatted_billing_address()) ?>
            </div>
        </div>
        <div class="mt-5">
            <h3 class="text-xl text-center font-bold font-garamond text-neutral-800">
                <?php esc_html_e('Payment details:','robert-theme'); ?>
            </h3>
            <div class="text-lg text-center mt-4">
                <?= esc_html($order->get_payment_method_title()) ?>
            </div>
        </div>
    </div>
