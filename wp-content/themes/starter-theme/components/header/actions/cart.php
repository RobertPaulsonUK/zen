<?php
    if(is_checkout()) {
        return;
    }
?>
<button id="cart-init-btn" class="shrink-0 cursor-pointer relative">
    <img src="<?= get_template_directory_uri() ?>/assets/images/icons/cart.svg" width="20px" height="20px" alt="cart-icon">
    <span id="cart-count" class="absolute block top-[-4px] right-[-4px] text-[8px] w-fit py-[1px] px-[4px] rounded-full bg-neutral-800 text-white-900">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
</button>