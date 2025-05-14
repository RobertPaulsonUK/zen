<?php
    if(is_user_logged_in()) {
        return;
    }
    $is_open = isset($_GET['login']) || isset($_GET['register']);
    $is_login_active = !isset($_GET['register']);
    ?>
<div id="authModal" class="fixed inset-0 bg-neutral-800/30 z-300 group/auth <?= !$is_open ? 'hidden' : '' ?>">
    <div class="fixed inset-0 backdrop-blur-xs z-301 flex items-center justify-center p-4 opacity-[1] transition-[opacity] duration-500 linear group-[.hidden]/auth:opacity-[0] cursor-pointer">
        <div class="p-8 rounded bg-white-900 max-w-[600px] w-full tab-wrapper auth-wrapper cursor-default relative">
            <button id="auth-close-btn" class="w-5 h-5 cursor-pointer absolute top-8 right-8" type="button">
                <span class="block w-full bg-neutral-800 h-[2px] rotate-[45deg]"></span>
                <span class="block w-full bg-neutral-800 h-[2px] -rotate-[45deg] mt-[-2px]"></span>
            </button>
            <div class="flex items-center justify-center gap-4 text-base font-semibold text-neutral-800">
                <button data-tab-id="login-tab" data-active="<?= $is_login_active ? 'true' : 'false' ?>" class="tabs-btn cursor-pointer p-2 uppercase  border-b border-transparent transition-colors duration-300 linear data-[active=true]:border-neutral-800">
                    <?php esc_html_e('Login','robert-theme'); ?>
                </button>
                <button data-tab-id="register-tab" data-active="<?= $is_login_active ? 'false' : 'true' ?>" class="tabs-btn cursor-pointer p-2 uppercase border-b border-transparent transition-colors duration-300 linear data-[active=true]:border-neutral-800">
                    <?php esc_html_e('Register','robert-theme'); ?>
                </button>
            </div>
            <div class="mt-5">
                <?php get_template_part('components/auth/form','login',['is_active' => $is_login_active]) ?>
                <?php get_template_part('components/auth/form','register',['is_active' => !$is_login_active]) ?>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('components/auth/error','modal') ?>
<?php get_template_part('components/auth/success','modal') ?>
