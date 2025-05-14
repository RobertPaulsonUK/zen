<?php
    $current_order = $_GET['orderby'] ?? 'menu_order';

    $ordering_data = [
        'menu_order' => __('Default sorting', 'robert_theme'),
        'popularity' => __('Sort by popularity', 'robert_theme'),
        'rating'     => __('Sort by average rating', 'robert_theme'),
        'date'       => __('Sort by latest', 'robert_theme'),
        'price'      => __('Sort by price: low to high', 'robert_theme'),
        'price-desc' => __('Sort by price: high to low', 'robert_theme'),
    ];
?>
<div id="archive-ordering-widget" class="relative z-[5] group/form">
    <button id="archive-ordering-button" type="button" class="cursor-pointer flex items-center gap-2 justify-between max-w-[300px] w-full text-sm text-neutral-800">
        <?= esc_html($ordering_data[$current_order]); ?>
        <span class="transition-transform duration-300 linear group-[.active]/form:rotate-[180deg]">
            &#9660;
        </span>
    </button>
    <div class="absolute w-max right-0 top-[40px] p-4 rounded bg-neutral-100 translate-x-[130%] transition-transform duration-300 linear group-[.active]/form:translate-x-0">
        <form class="w-full flex flex-col" method="GET">
            <?php foreach ($ordering_data as $key => $value): ?>
                <label class="flex group gap-2 items-center justify-start cursor-pointer w-full px-2 py-1 border border-transparent hover:border-neutral-800 rounded transition-colors duration-200 linear">
                    <span class="w-3 shrink-0 h-3 rounded-full bg-transparent border-4 border-neutral-800 opacity-0 transition-opacity duration-200 linear group-has-checked:opacity-[1]">
                    </span>
                    <span class="text-[#374151] text-sm shrink-0">
                        <?= esc_html($value) ?>
                    </span>
                    <input name="orderby"
                           type="radio"
                           value="<?= esc_html($key) ?>"
                           <?= $current_order === $key ? 'checked' : '' ?>
                           class="hidden">
                </label>
            <?php endforeach;?>
        </form>
    </div>
</div>