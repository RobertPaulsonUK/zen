<div class="py-[30px] flex flex-col items-center mx-auto gap-[30px] lg:mx-0 lg:items-start max-w-[400px] lg:px-[50px] lg:py-[50px] xl:px-[80px] xl:py-[80px] xl:max-w-[450px]">
    <?php get_template_part('components/footer/footer','logo'); ?>
    <div class="text-sm text-center lg:text-left">
        <?= esc_html(get_field('footer_text','option')); ?>
    </div>
    <?php print_arrow_link('footer_link','',true); ?>
</div>