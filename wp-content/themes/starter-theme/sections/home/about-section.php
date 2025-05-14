<?php
    $repeater = get_field('home_two_block_repeater');
    if(empty($repeater)) {
        return;
    }
    foreach ($repeater as $index => $item) {
        $args = [
            'title' => $item['title'],
            'text' => $item['text'],
            'image' => $item['image'],
            'link' => $item['link'],
            'is_reverse' => ($index + 1) % 2 === 0
        ];
        get_template_part('components/global/content','block',$args);
    }
    ?>
