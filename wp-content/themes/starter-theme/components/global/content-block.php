<?php
    $title = $args['title'] ?? '';
    $text = $args['text'] ?? '';
    $link = $args['link'] ?? null;
    $image = $args['image'] ?? null;
    $subtitle = $args['subtitle'] ?? null;
    $is_reverse = $args['is_reverse'] ?? false;
?>
<section>
    <div class="container mx-auto md:px-[16px]">
        <div class="flex flex-col <?= $is_reverse ? 'md:flex-row-reverse' : 'md:flex-row' ?>">
            <div class="py-[50px] px-[20px] bg-[#F7F6F5] md:max-w-1/2 md:grow-1 flex flex-col gap-[30px] items-center justify-center">
                <?php if($subtitle): ?>
                    <div class="text-center text-neutral-600 text-lg font-semibold uppercase">
                        <?= esc_html($subtitle) ?>
                    </div>
                <?php endif; ?>
                <h2 class="<?= esc_attr(heading_classes()) ?> text-[28px]">
                    <?= esc_html($title) ?>
                </h2>
                <div class="text-center text-base text-neutral-700 max-w-[390px]">
                    <?= esc_html($text) ?>
                </div>
                <?php if($link) {
                    $link_classes = 'py-[15px] px-[18px] block w-fit text-sm font-bold uppercase text-neutral-800 mx-auto relative after:content-[""] after:block after:absolute after:h-[1.5px] after:w-[calc(100%-36px)] after:bottom-[15px] after:left-1/2 after:-translate-x-1/2 after:bg-neutral-800 hover:after:w-full after:transition-[width] after:duration-300 after:linear';
                    print_link($link,$link_classes);
                    }
                ?>
            </div>
            <div class="md:max-w-1/2 md:grow-1">
                <?php print_simple_images($image,'w-full h-full object-cover min-h-[348px] object-right'); ?>
            </div>
        </div>
    </div>
</section>