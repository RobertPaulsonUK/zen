<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package robert-theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function robert_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    $classes[] = 'font-inter overflow-x-hidden';

	return $classes;
}
add_filter( 'body_class', 'robert_theme_body_classes' );

function body_data_attr():void {
    if(is_singular('post')) {
        $id = get_the_ID();
        echo ' data-post-id="' . $id . '"';
    }
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function robert_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'robert_theme_pingback_header' );

function print_archive_title() {
    $title = __('Blog','robert-theme');
    $page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;

    if(is_category()) {
        $title = single_cat_title('', false);
    }
    if(is_tag()) {
        $title = __('Tag','robert-theme') . ' - ' . single_tag_title('',false);
    }
    if(is_search()) {
        $search_query = get_search_query();
        $title = sprintf(__('Search results for: %s','robert-theme'),$search_query);
    }
    if($page_number > 1) {
        $title .= sprintf(' - %s %d',__('Page','robert-theme'),$page_number);
    }
    echo sprintf('<h2 class="%s">%s</h2>',heading_classes(),$title);
}
add_action('pre_get_posts', function ($query) {
    if ($query->is_search() && $query->is_main_query() && !is_admin()) {
        $query->set('post_type', ['product']);
    }
});
