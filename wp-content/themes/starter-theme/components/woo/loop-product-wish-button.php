
<?php
    global $product;
    if(!$product) {
        return;
    }
?>
<div class="absolute right-4 top-4 z-2">
    <?php if(is_user_logged_in()):
        $is_in_wishlist = is_product_in_wishlist($product->get_id());
        ?>
        <button data-product-id="<?= esc_attr($product->get_id()) ?>"
                data-in-wishlist="<?= esc_attr($is_in_wishlist ? 'true' : 'false') ?>"
                class="group cursor-pointer ajax-add-to-wishlist">
            <img width="25px" height="22px" src="<?= get_template_directory_uri() ?>/assets/images/icons/heart-icon.svg" alt="heart-icon" class="group-data-[in-wishlist=true]:hidden">
            <img width="25px" height="22px" src="<?= get_template_directory_uri() ?>/assets/images/icons/heart-fill.svg" alt="heart-icon" class="group-data-[in-wishlist=false]:hidden">
        </button>
    <?php else: ?>
        <button class="open-login-modal auth-init-button cursor-pointer">
            <img width="25px" height="22px" src="<?= get_template_directory_uri() ?>/assets/images/icons/heart-icon.svg" alt="heart-icon">
        </button>
    <?php endif; ?>
</div>
