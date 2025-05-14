<?php
    $popular_posts_query = get_most_popular_posts();
    $categories =  get_terms( [
        'taxonomy'   => 'category',
        'hide_empty' => true,
    ] );
    $tags =  get_terms( [
        'taxonomy'   => 'post_tag',
        'hide_empty' => true,
    ] );
    $title_classes = 'text-2xl text-neutral-800 font-semibold uppercase';
    ?>
    <div class="flex flex-col gap-[60px]">
        <?php if($popular_posts_query->have_posts()): ?>
            <div class="w-full">
                <h3 class="<?= esc_attr($title_classes) ?>">
                    <?php esc_html_e('Popular Posts','robert-theme'); ?>
                </h3>
                <div class="mt-[40px] flex flex-col gap-[20px]">
                    <?php while ($popular_posts_query->have_posts()) {
                        $popular_posts_query->the_post();
                        get_template_part('template-parts/loop/content','popular-post');
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($categories)): ?>
            <div class="w-full">
                <h3 class="<?= esc_attr($title_classes) ?>">
                    <?php esc_html_e('Categories','robert-theme'); ?>
                </h3>
                <div class="mt-[40px] flex flex-col gap-[20px]">
                    <?php foreach ($categories as $category)  {
                        get_template_part('template-parts/loop/content','post-category',['category' => $category]);
                    }?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($tags)): ?>
            <div class="w-full">
                <h3 class="<?= esc_attr($title_classes) ?>">
                    <?php esc_html_e('Tags Post','robert-theme'); ?>
                </h3>
                <div class="mt-[40px] flex flex-wrap gap-[12px]">
                    <?php foreach ($tags as $tag)  {
                        get_template_part('template-parts/loop/content','post-tag',['tag' => $tag]);
                    }?>
                </div>
            </div>
        <?php endif; ?>
    </div>
