<section class="py-section md:py-section-desktop">
    <div class="container mx-auto px-[16px] text-center">
        <div class="mx-auto max-w-[550px] text-block">
            <?= wpautop(get_the_content()) ?>
        </div>
        <div class="mt-[40px]">
            <?php
                $working_hours = get_field('global_working_hours','option');
                $email = get_field('global_email','option');
                $phone_number = get_field('global_phone_number','option');
                $location = get_field('global_location','option');
                $formatted_number = str_replace([' ','-','(',')','+'],'',$phone_number);
                $title_classes = 'text-neutral-700 text-sm font-semibold';
                $text_classes = 'text-light-brown text-sm font-semibold mt-[12px]'
            ?>
            <div class="flex flex-col items-center gap-[30px]">
                <?php if($working_hours): ?>
                    <div class="">
                        <h3 class="<?= esc_attr($title_classes) ?>">
                            <?php esc_html_e('Office Hours :','robert-theme') ?>
                        </h3>
                        <p class="<?= esc_attr($text_classes) ?>">
                            <?= $working_hours ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if($email): ?>
                    <div class="">
                        <h3 class="<?= esc_attr($title_classes) ?>">
                            <?php esc_html_e('Email:','robert-theme') ?>
                        </h3>
                        <a class="<?= esc_attr($text_classes) ?>"
                           href="<?= esc_url('mailto:' . $email) ?>">
                            <?= esc_html($email) ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if($phone_number): ?>
                    <div class="">
                        <h3 class="<?= esc_attr($title_classes) ?>">
                            <?php esc_html_e('Phone:','robert-theme') ?>
                        </h3>
                        <a class="<?= esc_attr($text_classes) ?>"
                           href="<?= esc_url('tel:' . $formatted_number) ?>">
                            <?= esc_html($phone_number) ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if($location): ?>
                    <div class="">
                        <h3 class="<?= esc_attr($title_classes) ?>">
                            <?php esc_html_e('Location :','robert-theme') ?>
                        </h3>
                        <p class="<?= esc_attr($text_classes) ?>">
                            <?= $location ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="mt-10 max-w-[800px] mx-auto text-sm text-neutral-800">
            <?= do_shortcode('[contact-form-7 id="09920a7" title="Contact form"]'); ?>
        </div>
    </div>
</section>