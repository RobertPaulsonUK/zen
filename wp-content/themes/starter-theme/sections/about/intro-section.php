<?php
    $repeater = get_field('about_one_repeater');
    $title = get_the_title() . ' ' . get_bloginfo('name');
    ?>
    <section id="mission" class="py-section md:py-section-desktop">
        <h1 class="<?= esc_attr(heading_classes()) ?>">
            <?= esc_html($title) ?>
        </h1>
        <div class="max-w-[450px] mx-auto mt-[30px] text-block text-center">
            <?= wpautop(get_the_content()) ?>
        </div>
        <?php if(!empty($repeater)): ?>
            <div class="mt-[50px]">
                <?php foreach ($repeater as $index => $item) {
                    $item_args = array(
                        'title' => $item['title'],
                        'text' => $item['text'],
                        'image' => $item['image'],
                        'is_reverse' => ($index + 1) % 2 === 0
                    );
                    get_template_part('components/global/content','block',$item_args);
                } ?>
            </div>
        <?php endif; ?>
    </section>
