<?php

    $image_id = get_post_thumbnail_id(get_the_ID());
    $image_src = wp_get_attachment_image_src($image_id, 'full')[0];
    $image = array(
        'title' => 'contacts image',
        'url' => $image_src
    );
    $title = __('CONTACT US','robert-theme');
    $logo = array(
        'title' => 'logo',
        'url'  => get_template_directory_uri() . '/assets/images/contacts/logo.svg'
    );
    ?>
    <section class="relative z-[1]">
        <?php print_simple_images($image,'w-full h-full object-cover min-h-[400px] object-center md:object-right'); ?>
        <div class="py-[50px] flex flex-col gap-[30px] items-center justify-center bg-[#3A3845] w-full md:absolute md:left-0 md:top-0 md:bottom-0 md:max-w-[400px] lg:left-[40px] 2xl:left-[80px]">
            <?php print_simple_images($logo,'w-[50px] h-[50px]'); ?>
            <div class="text-center">
                <h1 class="text-[38px] max-w-[250px] mx-auto font-garamond leading-[40px] font-bold text-white-900 mt-[25px]">
                    <?= esc_html($title) ?>
                </h1>
                <?php get_template_part('components/global/social-media','block') ?>
            </div>
        </div>
    </section>
