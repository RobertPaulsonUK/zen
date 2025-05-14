<?php
    register_nav_menus(array(
        'header_menu' => 'Header menu',
        'footer_menu' => 'Footer menu'
    ));

    function robert_register_header_menu()
    {
        wp_nav_menu(array(
            'theme_location' => 'header_menu',
            'container'            => 'nav',
            'container_class' => 'h-auto grow-1 flex items-center',
            'menu_class'    => 'flex flex-col md:flex-row gap-[20px] lg:gap-[40px] xl:gap-[60px] items-center',
        ));
    }
    function robert_register_footer_menu()
    {
        wp_nav_menu(array(
            'theme_location' => 'footer_menu',
            'container'            => 'nav',
            'container_class' => 'py-[30px] border-y border-neutral-300 lg:border-none lg:px-[50px] lg:py-[50px] xl:px-[80px] xl:py-[80px]',
            'menu_class'    => 'grid grid-cols-2 md:grid-cols-3 gap-[48px] lg:gap-[72px]',
        ));
    }

    function robert_add_custom_link_class($atts, $item, $args)
    {
        if ( ! isset($atts['class'])) {
            $atts['class'] = '';
        }
        $is_header_menu = $args->menu->slug === 'header-menu';
        if($is_header_menu) {
            $atts['class'] = 'text-lg font-normal text-warm-black';
        } else {
            if(in_array('menu-item-has-children',$item->classes)) {
                $atts['class'] = 'text-base font-semibold text-neutral-100 uppercase';
            } else {
                $atts['class'] = 'text-sm font-normal text-neutral-300';
            }
        }

        return $atts;
    }
    function robert_add_custom_li_class($classes, $item, $args, $depth)
    {
        $classes[] = '';


        return $classes;
    }
    function robert_add_submenu_class($atts, $args, $depth)
    {
        if ( ! isset($atts['class'])) {
            $atts['class'] = '';
        }
        $atts['class'] = 'flex flex-col gap-[15px] mt-[30px]';
        return $atts;
    }

    add_filter('nav_menu_submenu_attributes','robert_add_submenu_class',10,3);

    add_filter('nav_menu_link_attributes', 'robert_add_custom_link_class', 10, 3);
    add_filter('nav_menu_css_class', 'robert_add_custom_li_class', 10, 4);
