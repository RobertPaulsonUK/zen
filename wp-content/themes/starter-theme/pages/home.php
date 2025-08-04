<?php
    /*
    Template Name: Home
*/
    get_header();
   ?>
    <main class="main">
        <?php
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content','home');
            }
        ?>
    </main>
    <?php get_footer(); ?>