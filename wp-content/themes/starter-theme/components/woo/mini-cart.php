<?php
    if(is_checkout()) {
        return;
    }
?>
<div id="cart-modal" class="fixed cursor-pointer hidden z-101 inset-0 backdrop-blur-sm flex items-center justify-end group/modal" data-open="false">
    <div id="mini-cart" class="modal-cart cursor-default p-5 bg-white-900 h-[100vh] drop-shadow-xl translate-x-[110%] transition-translate duration-300 linear group-data-[open=true]/modal:translate-x-0 w-full sm:max-w-[400px]">
        <div class="flex w-full items-center justify-between">
            <h3 class="text-2xl font-semibold text-neutral-800">
                <?php esc_html_e('Cart','robert-theme'); ?>
            </h3>
            <button id="cart-modal-close-btn" class="w-5 h-5 cursor-pointer" type="button">
                <span class="block w-full bg-neutral-800 h-[2px] rotate-[45deg]"></span>
                <span class="block w-full bg-neutral-800 h-[2px] -rotate-[45deg] mt-[-2px]"></span>
            </button>
        </div>
        <div class="mt-5 h-[calc(100vh-100px)] w-full">
            <div class="widget_shopping_cart_content">
                <?php woocommerce_mini_cart(); ?>
            </div>
        </div>

    </div>
</div>