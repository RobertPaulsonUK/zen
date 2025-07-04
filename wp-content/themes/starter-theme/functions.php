<?php
/**
 * robert-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package robert-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function robert_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on robert-theme, use a find and replace
		* to change 'robert-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'robert-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);



	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 38,
			'width'       => 145,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'robert_theme_setup' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Navigation file add.
 */

require get_template_directory() . '/inc/navigation.php';

/**
 * Enqueue styles and scripts.
 */
require get_template_directory() . '/inc/enqueue-styles-and-scripts.php';

/**
 * Allow svg files uploading.
 */
require get_template_directory() . '/inc/Allow_SVG_Upload.php';
Allow_SVG_Upload::init();

/**
 * Add file with custom theme functions.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Add file with ajax functions.
 */
require get_template_directory() . '/inc/ajax-increment-post-view.php';
/**
 * Add Woocommerce main file.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Add file with woocommerce functions.
 */
require get_template_directory() . '/woocommerce/inc/wc-functions.php';
/**
 * Add file with custom auth.
 */
require get_template_directory() . '/inc/ajax-auth.php';




