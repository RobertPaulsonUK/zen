<section class="py-section md:py-section-desktop">
    <div class="container mx-auto px-[16px] text-center">
        <h4 class="text-base text-neutral-700 font-semibold">
            <?php esc_html_e('Sign up for emails','robert-theme'); ?>
        </h4>
        <h2 class="mt-[20px] <?= esc_attr(heading_classes()) ?> text-[28px]">
            <?php esc_html_e('For news, collections & more','robert-theme'); ?>
        </h2>
        <div class="mt-[20px] max-w-[390px] mx-auto">
            <?= do_shortcode('[contact-form-7 id="2b4c7ae" title="Registration form"]'); ?>
        </div>
    </div>
</section>