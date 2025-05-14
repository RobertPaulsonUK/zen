<div id="menu-wrapper" class="h-[calc(100vh-62px)] flex flex-col items-center gap-8  p-8 border-top border-t border-neutral-700 fixed z-[100] bottom-0 bg-white-900 right-0 left-0 translate-x-[-110%] data-[open=true]:translate-x-0 transition-transform duration-500 linear md:translate-x-0 md:h-fit md:border-none md:p-0 md:static">

    <div class="flex gap-6 items-center md:hidden">
        <?php
            get_template_part('components/header/actions/search','',['is_mobile' => true]);
            get_template_part('components/header/actions/profile','',['is_mobile' => true]);
            get_template_part('components/header/actions/wishlist','link',['is_mobile' => true]);
        ?>
    </div>
    <?php robert_register_header_menu() ?>
</div>