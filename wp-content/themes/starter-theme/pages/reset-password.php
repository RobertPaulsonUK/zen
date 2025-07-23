<?php
    /*
    Template Name: Reset password page
*/
    get_header();
    ?>
    <main class="main">
        <?php
            while(have_posts()) {
                the_post();
                get_template_part('template-parts/content','reset-password');
            }
        ?>
    </main>
    <?php get_footer(); ?>