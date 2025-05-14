<?php
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    if($total_pages < 2) {
        return;
    }
?>
<div class="flex gap-2 justify-center items-center mt-5 md:mt-8">
    <?= paginate_links(
        [
            'prev_text' => '&#8592;',
            'next_text' => '&#8594;',
            'mid_size' => 2
        ]);
    ?>
</div>