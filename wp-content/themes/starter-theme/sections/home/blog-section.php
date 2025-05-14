<?php
    $posts = wp_get_recent_posts([
        'numberposts' => 1,
        'post_status' => 'publish'
    ]);
    $post = $posts[0];
    if(empty($post)) {
        return;
    }
    $categories = get_the_category($post['ID']);
    $category_name = $categories[0]->name;
    $image_id = get_post_thumbnail_id($post['ID']);
    $image_src = $image_id ? wp_get_attachment_image_src($image_id, 'full')[0] : '';
    ?>
    <section class="pt-section md:pt-section-desktop">
        <h2 class="<?= esc_attr(heading_classes()) ?>">
            <?php esc_html_e('Our blog','robert-theme'); ?>
        </h2>
        <div class="mt-[30px]">
            <?php
                $content_args = array(
                    'subtitle' => $category_name,
                    'title' => $post['post_title'],
                    'text' => wp_trim_words($post['post_content'],14,'...'),
                    'link' => [
                        'url' => get_permalink($post['ID']),
                        'target' => '_self',
                        'title' => __('Read more','robert-theme')
                    ],
                    'image' => [
                        'title' => $post['post_title'],
                        'url' => $image_src
                    ]
                );
                get_template_part('components/global/content','block',$content_args);
            ?>
        </div>
    </section>