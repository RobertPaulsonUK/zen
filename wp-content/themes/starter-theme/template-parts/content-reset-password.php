<?php

?>
<section class="py-25 md:py-50">
    <div class="container">
        <h1 class="<?= heading_classes() ?>">
            <?php the_title() ?>
        </h1>
        <form id="reset-password-form" class="mt-10 max-w-100 mx-auto">
            <label data-step="0" class="w-full flex flex-col">
                    <span class="form-title">
                        <?php esc_html_e( 'Email address', 'robert-theme' ); ?>
                    </span>
                <input type="email" class="form-input" name="email" placeholder="Email address" required />
            </label>
            <label data-step="1" class="w-full flex flex-col hidden">
                    <span class="form-title">
                        <?php esc_html_e( 'Enter code', 'robert-theme' ); ?>
                    </span>
                <input type="text" min="6" class="form-input" placeholder="Code"/>
            </label>
            <label data-step="2" class="w-full flex flex-col relative hidden">
                <span class="form-title">
                    <?php esc_html_e( 'Enter new password', 'robert-theme' ); ?>
                </span>
                <input type="password" class="form-input" placeholder="Password" />
                <a class="absolute eye-link group/eye cursor-pointer bottom-[23px] right-[10px] translate-y-1/2 opacity-[0.5] data-[active=true]:opacity-[1]" data-active="false">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/icons/eye.svg" width="20x" height="20px" alt="eye">
                    <span class="absolute bottom-[10px] right-[0px] translate-y-1/2 w-5 h-[2px] rotate-[-45deg] bg-neutral-800 group-data-[active=true]/eye:hidden"></span>
                </a>
            </label>
            <button type="submit"
                    class="w-full mt-4 flex items-center justify-center h-10 mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800"
                    name="login"
                    value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                <?php esc_html_e( 'Send', 'woocommerce' ); ?>
            </button>
        </form>
    </div>
</section>