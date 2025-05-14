<?php
    if(is_front_page()) {
        return;
    }
    $home_text = __('Home','robert-theme');
    $wrapper_class = $args['wrapper_class'] ?? 'py-[20px] md:py-[30px]';
    $page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $breadcrumbs_list = array(
        array(
            'title' => $home_text,
            'url' => home_url()
        )
    );
    if(is_home()) {
        $page_title = __('Blog','robert-theme');
        $breadcrumbs_list[] = array(
            'title' => $page_title,
            'url' => get_permalink( get_option( 'page_for_posts' ))
        );
    }
    if(is_page()) {
        $page_id = get_the_ID();
        $ancestors = get_post_ancestors($page_id);
        if($ancestors) {
            $parent_id = $ancestors[0];
            $parent_name = esc_html(get_the_title($parent_id));
            $breadcrumbs_list[] = array(
                'title' => $parent_name,
                'url' => get_permalink($parent_id)
            );
        }
        $breadcrumbs_list[] = array(
            'title' => get_the_title(get_the_ID()),
            'url' => null
        );
    }
    if(is_category()) {
        $blog_title = __('Blog','robert-theme');
        $breadcrumbs_list[] = array(
            'title' => $blog_title,
            'url' => get_permalink( get_option( 'page_for_posts' ))
        );
        $breadcrumbs_list[] = array(
            'title' => single_cat_title('', false),
            'url' => null
        );
    }
    if(is_tag()) {
        $blog_title = __('Blog','robert-theme');
        $breadcrumbs_list[] = array(
            'title' => $blog_title,
            'url' => get_permalink( get_option( 'page_for_posts' ))
        );
        $breadcrumbs_list[] = array(
            'title' => __('Tag','robert-theme') . ' - ' . single_tag_title('',false),
            'url' => null
        );
    }
    if(is_singular('post')) {
        $post_id = get_the_ID();
        $breadcrumbs_list[] = array(
            'title' => __('Blog','robert-theme'),
            'url' => get_permalink( get_option( 'page_for_posts' ) )
        );
        $categories = get_the_category($post_id);
        $category_name = $categories[0]->name;
        if($category_name && $category_name !== 'Uncategorized') {
            $category_link = get_category_link( $categories[0]->term_id );
            $breadcrumbs_list[] = array(
                'title' => $category_name,
                'url' => $category_link
            );
        }
        $breadcrumbs_list[] = array(
            'title' => get_the_title(get_the_ID()),
            'url' => null
        );
    }
    if(is_404()) {
        $breadcrumbs_list[] = array(
            'title' => 404,
            'url' => null
        );
    }
    if(is_search()) {
        $breadcrumbs_list[] = array(
            'title' => __('Search results','robert-theme'),
            'url' => get_search_link(get_search_query())
        );
    }
    if($page_number > 1) {
        $breadcrumbs_list[] = array(
            'title' => __('Page ','robert-theme') . $page_number,
            'url' => null
        );
    }
?>

<div class="<?= $wrapper_class ?>">
    <div class="container mx-auto px-[16px]">
        <ul class="flex gap-[12px] flex-wrap items-center">
            <?php
                $total_items = count($breadcrumbs_list);
                foreach ($breadcrumbs_list as  $index => $item): ?>
                    <?php if(($index + 1) !== $total_items): ?>
                        <li class="relative after:content-[''] after:block after:w-[4px] after:h-[4px] after:absolute after:top-1/2 after:right-[-6px] after:rounded-full after:translate-x-1/2 after:translate-y-[-50%] after:bg-neutral-800/60">
                            <a class="block text-[14px] md:text-[18px] font-normal text-neutral-800 font-garamond leading-[20px]"
                               href="<?php echo $item['url'] ?>">
                                <?php echo $item['title'] ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <p class="text-[14px] md:text-[18px] font-normal text-neutral-800/60 font-garamond leading-[20px]">
                                <?php echo $item['title'] ?>
                            </p>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
        </ul>
    </div>
</div>