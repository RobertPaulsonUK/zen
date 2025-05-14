<?php
    /*
    Template Name: About us
*/
    get_header();
    ?>
    <main class="main">
        <?php
            while(have_posts()) {
                the_post();
                get_template_part('template-parts/content','about');
            }
        ?>
    </main>
    <?php get_footer(); ?>