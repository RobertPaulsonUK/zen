<?php
    $wishlist_products_ids = get_wishlist_product_ids();
?>
<?php if(!empty($wishlist_products_ids)): ?>
<div id="account-wishlist-wrapper" class="py-4 px-3 rounded-xl border-[3px] border-neutral-800/20 text-neutral-800">
        <div class="flex flex-col gap-5">
            <?php foreach ($wishlist_products_ids as $index => $products_id) {
                $is_last = count($wishlist_products_ids) === ($index + 1);
                get_template_part('components/woo/loop-account','wishlist-item',['product_id' => $products_id,'is_last' => $is_last]);
            } ?>
        </div>
</div>
<?php endif;?>
<div id="empty-wishlist-message" class="py-4 px-3 rounded-xl border-[3px] border-neutral-800/20 text-neutral-800 uppercase font-semibold text-center <?= empty($wishlist_products_ids) ? '' : 'hidden' ?>">
    <?php esc_html_e("You don't have any products in your wishlist now.",'robert-theme'); ?>
    <a href="<?= esc_url(get_permalink( wc_get_page_id( 'shop' ) )) ?>"
       class="mx-auto max-w-[300px] w-full mt-4 flex items-center justify-center h-10 mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800">
        <?= __('To shop','robert-theme') ?>
    </a>
</div>
