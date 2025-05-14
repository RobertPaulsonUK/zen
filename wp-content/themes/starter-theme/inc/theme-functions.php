<?php
    function dd($var)
    {
        echo '<pre style=" background: #000; color: green; padding: 15px; font-size: 12px;">';
        print_r($var);
        echo '</pre>';
        die();
    }
    if ( function_exists( 'acf_add_options_page' ) ) {

        $option_page = acf_add_options_page( array(
            'page_title' => 'Global options',
            'menu_title' => 'Global options',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect'   => false
        ) );
    }
    function print_simple_images(null | string | array $image, string $classes,bool $global = false) {
        if(!$image) {
            return;
        }
        $ready_image = is_string($image) ? get_field($image,$global ? 'option' : '') : $image;
        if(empty($ready_image) || !is_array($ready_image)) {
            return;
        }
        ?>
        <img src="<?= esc_url($ready_image['url']); ?>"
             alt="<?= esc_attr($ready_image['title']) ?>"
             class="<?= esc_html($classes) ?>"
        >
        <?php
    }
    function print_link(null | array | string $link, string $classes, bool $type = false) {
        if(!$link) {
            return;
        }
        $option = $type ? 'option' : '';
        $ready_link = is_string($link) ? get_field($link,$option) : $link;
        if(empty($ready_link) || !is_array($ready_link)) {
            return;
        }
        ?>
        <a href="<?= esc_url($ready_link['url']); ?>"
           target="<?= esc_attr($ready_link['target']) ; ?>"
           class="<?= esc_attr($classes); ?>">
            <?= esc_html($ready_link['title']); ?>
        </a>
        <?php
    }

    function print_arrow_link(null |array | string $link, string $classes, bool $type = false)
    {
        if(!$link) {
            return;
        }
        $option = $type ? 'option' : '';
        $ready_link = is_string($link) ? get_field($link,$option) : $link;
        if(empty($ready_link) || !is_array($ready_link)) {
            return;
        }
        $link_classes = 'flex gap-2 items-center py-[16px] px-[18px] text-neutral-300 border border-neutral-300 text-sm uppercase ';
        $link_classes .= $classes;
        ?>
        <a href="<?= esc_url($ready_link['url']); ?>"
           target="<?= esc_attr($ready_link['target']) ; ?>"
           class="<?= esc_attr($link_classes); ?>">
            <?= esc_html($ready_link['title']); ?>
            <img width="8px" height="7px" src="<?= get_template_directory_uri() ?>/assets/images/icons/arrow-right.svg" alt="arrow-right">
        </a>
        <?php
    }
//    Add custom meta field to posts
    add_action('save_post_post', 'set_default_views_meta_for_posts', 10, 3);

    function set_default_views_meta_for_posts($post_id, $post, $update) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if (get_post_meta($post_id, 'views', true) === '') {
            update_post_meta($post_id, 'views', 0);
        }
    }

    function heading_classes():string
    {
        return 'font-bold font-garamond text-4xl uppercase text-neutral-800 text-center';
    }
    function get_most_popular_posts():WP_Query {
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'meta_key'       => 'views',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ];

        return new WP_Query($args);
    }
    function get_static_related_posts($post_id, $count = 3) {
        $related = get_post_meta($post_id, '_static_related_posts', true);

        if (!$related) {
            $args = [
                'post__not_in' => [$post_id],
                'posts_per_page' => $count,
                'orderby' => 'rand',
                'post_type' => 'post',
            ];
            $posts = get_posts($args);
            $related_ids = wp_list_pluck($posts, 'ID');

            update_post_meta($post_id, '_static_related_posts', $related_ids);
            return $posts;
        }

        return get_posts([
            'post__in' => $related,
            'orderby' => 'post__in'
        ]);
    }

