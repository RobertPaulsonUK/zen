<section>
    <div class="container mx-auto md:px-[16px]">
        <div class="flex flex-col md:flex-row">
            <div class="py-[50px] px-[20px] bg-[#F7F6F5] md:max-w-1/2 md:grow-1 flex flex-col gap-[30px] items-center justify-center">
                <h2 class="<?= esc_attr(heading_classes()) ?> text-[28px]">
                    <?php the_field('home_one_block_title'); ?>
                </h2>
                <div class="text-center text-base text-neutral-700 max-w-[390px]">
                    <?php the_field('home_one_block_text'); ?>
                </div>
                <?php
                    $link_classes = 'py-[15px] px-[18px] block w-fit text-sm font-bold uppercase text-neutral-800 mx-auto relative after:content-[""] after:block after:absolute after:h-[1.5px] after:w-[calc(100%-36px)] after:bottom-[15px] after:left-1/2 after:-translate-x-1/2 after:bg-neutral-800 hover:after:w-full after:transition-[width] after:duration-300 after:linear';
                    print_link('home_one_block_link',$link_classes);
                ?>
            </div>
            <div class="md:max-w-1/2 md:grow-1">
                <?php print_simple_images('home_one_block_image','w-full h-full object-cover min-h-[348px] object-right'); ?>
            </div>
        </div>
    </div>
</section>