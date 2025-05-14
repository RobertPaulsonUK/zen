<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package robert-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php body_data_attr(); ?>>
<?php wp_body_open(); ?>
	<header id="header"
            data-menu-open="false"
            class="fixed z-[100] py-[14px] md:py-[28px] bg-white-900  top-0 left-0 right-0 data-[menu-open=false]:drop-shadow-lg">
        <div class="container mx-auto px-[16px]">
            <div class="flex items-center justify-between">
                <?php
                    get_template_part('components/header/actions/burger');
                    get_template_part('components/header/header','logo');
                    get_template_part('components/header/header','menu');
                    get_template_part('components/header/header','actions');
                ?>
            </div>
        </div>
	</header><!-- #masthead -->
    <?php get_template_part('components/woo/mini','cart') ?>
<div id="page" class="wrapper pt-[68px] md:pt-[92px]">
