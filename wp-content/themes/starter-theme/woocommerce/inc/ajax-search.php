<?php
    add_action('wp_ajax_zen_search_products', 'ajax_search_products');
    add_action('wp_ajax_nopriv_zen_search_products', 'ajax_search_products');

    function ajax_search_products() {
        $args = array(
            'post_type'      => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            's'              => sanitize_text_field($_POST['search_value'])
        );
        $query = new WP_Query($args);
        $output = ob_start(PHP_OUTPUT_HANDLER_CLEANABLE);?>
        <ul class="flex flex-col gap-4 w-full p-2 rounded bg-white-900 max-h-[330px] overflow-y-auto">
            <?php if($query->have_posts()): ?>
                <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/loop/content','search');
                    }
                    wp_reset_postdata();
             else: ?>
                <li>
                    <p class="text-sm text-neutral-800 p-4 text-center font-bold">
                        <?php esc_html_e('Nothing found'); ?>
                    </p>
                </li>
            <?php endif; ?>
        </ul>
        <?php
        $output .= ob_get_clean();
        wp_send_json($output);
        wp_die();
    }
