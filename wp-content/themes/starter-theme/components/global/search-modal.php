<div data-open="false" id="search-modal" class="flex fixed px-4 bg-warm-black inset-0 backdrop-blur-xs items-center justify-center cursor-pointer opacity-0 pointer-events-none z-[-100] invisible transition-opacity duration-500 linear data-[open=true]:opacity-[1] data-[open=true]:visible data-[open=true]:z-[200] data-[open=true]:pointer-events-auto">
    <form class="relative max-w-[400px] w-full cursor-static search-form"
          role="search"
          method="GET"
          action="<?= esc_url(home_url('/')) ?>"
    >
        <input type="text"
               autocomplete="off"
               id="ajax-search-input"
               class="rounded peer bg-white-900 px-[18px] py-[15px] pr-[40px] w-full focus:outline-0"
               name="s"
               placeholder="<?php esc_html_e('Enter your request','robert-theme') ?>">
        <button type="submit" class="absolute top-[17px] right-[18px] cursor-pointer opacity-[0.3] peer-focus:rotate-y-[180deg] peer-focus:opacity-[1] transition-transform transition-opacity duration-300 linear">
            <img width="20px" height="20px" src="<?= get_template_directory_uri() ?>/assets/images/icons/search.svg" alt="search-button">
        </button>
        <div id="ajax-search-wrapper" class="absolute top-[120%] left-0 right-0">
            <!--     output       -->
        </div>
    </form>
</div>