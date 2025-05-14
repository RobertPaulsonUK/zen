<?php
    $name = $args['name'] ?? '';
    $title = $args['title'] ?? '';
    $value = $args['value'] ?? '';
    $is_checked = isset($_GET[$name]) && in_array($value,$_GET[$name]);
    ?>
    <label class="group relative cursor-pointer pl-7">
        <span class="block absolute left-0 top-1/2 -translate-y-1/2 w-4 h-4 border border-neutral-800">
        </span>
        <span class="block absolute left-[1px] top-1/2 text-neutral-800 font-bold text-base opacity-0 transition-opacity duration-200 linear -translate-y-1/2 group-has-checked:opacity-[1]">
            ✓
        </span>
        <span class="text-[#374151] text-sm">
            <?= esc_html($title) ?>
        </span>
        <input type="checkbox"
               class="hidden"
                <?= $is_checked ? 'checked' : '' ?>
               name="<?= esc_attr($name) ?>[]"
               value="<?= esc_attr($value) ?>">
    </label>
