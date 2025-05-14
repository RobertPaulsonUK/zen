<?php
    /**
     * Enqueue scripts and styles.
     */
    function robert_scripts() {
        wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/output.css', array(), _S_VERSION );
        wp_enqueue_style( 'swiper-style', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), _S_VERSION );
        wp_enqueue_style( 'robert-style', get_stylesheet_uri(), array(), _S_VERSION );

        wp_enqueue_script( 'robert-js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
        wp_enqueue_script( 'ajax-js', get_template_directory_uri() . '/assets/js/ajax.js', array(), _S_VERSION, true );
        wp_localize_script('ajax-js','data',array('ajax_url'  => admin_url( 'admin-ajax.php' )));
        wp_enqueue_script( 'auth-js', get_template_directory_uri() . '/assets/js/auth.js', array(), _S_VERSION, true );
        wp_localize_script('auth-js','data',array('ajax_url'  => admin_url( 'admin-ajax.php' )));
        wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), _S_VERSION, true );
        wp_enqueue_script( 'sliders-js', get_template_directory_uri() . '/assets/js/sliders.js', array('swiper'), _S_VERSION, true );
    }
    add_action( 'wp_enqueue_scripts', 'robert_scripts' );