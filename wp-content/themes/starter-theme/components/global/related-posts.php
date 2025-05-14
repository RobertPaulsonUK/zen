<?php
    $related_posts = get_static_related_posts(get_the_ID());
    if(empty($related_posts)) {
        return;
    }
    ?>
    <section class="py-section md:py-section-desktop">
        <div class="container p-4 mx-auto">
            <h2 class="<?= esc_attr(heading_classes()) ?>">
                <?php esc_html_e('You may be interested','robert-theme'); ?>
            </h2>
            <div class="mt-7 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($related_posts as $post) {
                    setup_postdata($post);
                    get_template_part('template-parts/loop/content','post');
                }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
