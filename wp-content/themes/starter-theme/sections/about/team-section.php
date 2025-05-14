<?php
    $workers = get_field('about_team_repeater');
    if(empty($workers)) {
        return;
    }
    ?>
    <section id="team" class="py-section md:py-section-desktop">
        <div class="container px-[16px] mx-auto">
            <h2 class="<?= esc_attr(heading_classes()) ?>">
                <?php the_field('about_team_title'); ?>
            </h2>
            <div id="workers-slider" class="mt-[40px] mySwiper overflow-x-hidden">
                <div class="swiper-wrapper">
                    <?php foreach ($workers as $worker) {
                        get_template_part('template-parts/loop/content','worker',['worker' => $worker]);
                    } ?>
                </div>
            </div>
        </div>
    </section>
