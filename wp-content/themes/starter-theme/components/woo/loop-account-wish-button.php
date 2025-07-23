<?php
    $product_id = $args['product_id'] ?? 1;
    ?>
    <div class="mx-auto w-fit">
        <button data-product-id="<?= esc_attr($product_id) ?>"
                data-remove-item="true"
                data-in-wishlist="true"
                class="group cursor-pointer ajax-add-to-wishlist flex flex-col items-center justify-center p-0.5 w-7 h-7 rounded-full border-[2px] border-red-600">
            <span class="block w-full h-[2px] bg-red-600 rotate-[45deg] mb-[-1px]"></span>
            <span class="block w-full h-[2px] bg-red-600 rotate-[-45deg]"></span>
        </button>
    </div>
