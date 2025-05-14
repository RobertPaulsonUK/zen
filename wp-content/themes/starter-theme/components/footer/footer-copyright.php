<?php
    $copyright = get_field('footer_copyright','option');
    if(empty($copyright)) {
        return;
    }
    ?>
<div class="p-[30px] text-center text-neutral-500 xl:border-t xl:border-neutral-300">
    <?= esc_html($copyright) ?>
</div>
