<section id="work" class="pt-section md:pt-section-desktop">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:max-w-1/2 md:grow-1">
                <?php print_simple_images('about_work_image','w-full h-full object-cover min-h-[348px] object-right'); ?>
            </div>
            <div class="py-[36px] px-[20px] md:py-[48px] md:px-[60px] text-block md:max-w-1/2 md:grow-1">
                <?= wpautop(get_field('about_work_content')) ?>
            </div>
        </div>
    </div>
</section>