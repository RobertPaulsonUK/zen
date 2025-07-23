<?php
    $image = get_field('home_intro_image');
    $title = get_field('home_intro_title');
    $subtitle = get_field('home_intro_subtitle');
    $link = get_field('home_intro_link');
    $logo = get_field('home_intro_logo');
    ?>
    <section class="relative z-1">
        <?php print_simple_images($image,'w-full h-full object-cover md:min-h-[calc(100vh-92px)] object-right'); ?>
        <div class="py-[50px] flex flex-col gap-[30px] items-center justify-center bg-dark-brown w-full md:absolute md:left-0 md:top-0 md:bottom-0 md:max-w-[400px] lg:left-[40px] 2xl:left-[80px]">
            <?php print_simple_images($logo,'w-[50px] h-[50px]'); ?>
            <div class="text-center">
                <h4 class="text-base font-normal text-white-900">
                    <?= esc_html($subtitle) ?>
                </h4>
                <h1 class="text-[38px] max-w-[250px] mx-auto font-garamond leading-[40px] font-bold text-white-900 mt-[25px]">
                    <?= esc_html($title) ?>
                </h1>
            </div>
            <?php print_link($link,'px-[18px] py-[15px] text-center w-full max-w-[220px] bg-white-900 text-dark-brown text-sm md:text-base uppercase'); ?>
        </div>
    </section>
