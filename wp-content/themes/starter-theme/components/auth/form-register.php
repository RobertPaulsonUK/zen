<?php
    $is_active = $args['is_active'] ?? false;
?>
<div id="register-tab" data-active="<?= $is_active ? 'true' : 'false' ?>" class="hidden tab-item data-[active=true]:block">
    <h2 class="text-neutral-800 text-2xl uppercase text-center font-semibold">
        <?php esc_html_e( 'Register', 'woocommerce' ); ?>
    </h2>
    <form id="register-form" class="mt-4" method="post">
        <div class="flex flex-col gap-4">
            <label class="w-full">
                <span class="form-title">
                    <?php esc_html_e( 'Login or email address', 'robert-theme' ); ?>
                </span>
                <input type="text" class="form-input" name="login" placeholder="Login or email address" required />
            </label>
            <label class="w-full relative">
                <span class="form-title">
                    <?php esc_html_e( 'Password', 'robert-theme' ); ?>
                </span>
                <input type="password" class="form-input" name="password" placeholder="Your password" required />
                <a class="absolute eye-link group/eye cursor-pointer bottom-[23px] right-[10px] translate-y-1/2 opacity-[0.5] data-[active=true]:opacity-[1]" data-active="false">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/icons/eye.svg" width="20x" height="20px" alt="eye">
                    <span class="absolute bottom-[10px] right-[0px] translate-y-1/2 w-5 h-[2px] rotate-[-45deg] bg-neutral-800 group-data-[active=true]/eye:hidden"></span>
                </a>
            </label>
            <label class="w-full relative">
                <span class="form-title">
                    <?php esc_html_e( 'Repeat password', 'robert-theme' ); ?>
                </span>
                <input type="password" class="form-input" name="password_complete" placeholder="Repeat password" required />
                <a class="absolute eye-link group/eye cursor-pointer bottom-[23px] right-[10px] translate-y-1/2 opacity-[0.5] data-[active=true]:opacity-[1]" data-active="false">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/icons/eye.svg" width="20x" height="20px" alt="eye">
                    <span class="absolute bottom-[10px] right-[0px] translate-y-1/2 w-5 h-[2px] rotate-[-45deg] bg-neutral-800 group-data-[active=true]/eye:hidden"></span>
                </a>
            </label>
        </div>
        <div class="mt-4">
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <button type="submit"
                    class="w-full mt-4 flex items-center justify-center h-10 mt-3 py-[15px] px-[18px] border lg:border-transparent bg-neutral-800 text-neutral-100 text-sm font-semibold uppercase cursor-pointer transition-colors duration-300 linear hover:text-neutral-800 hover:bg-neutral-100 hover:border-neutral-800"
                    name="login"
                    value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                <?php esc_html_e( 'Register', 'woocommerce' ); ?>
            </button>
        </div>
    </form>
</div>
