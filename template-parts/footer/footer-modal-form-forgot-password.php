<?php

$enableSignUp = false;
if (get_option('users_can_register')) {
    $enableSignUp =  true;
}

$enableRecaptcha = boolval($args['is_enable_recaptcha']);
$recaptcha_site_key = $args['recaptcha_site_key'];
$recaptcha_secret_key = $args['recaptcha_secret_key'];

?>

<div class="fixed hidden inset-0 z-10 overflow-y-auto" data-ncmaz-modal-name="ncmaz-modal-form-forgot-password">
    <div class="flex items-center justify-center sm:block min-h-screen px-4 text-center">
        <div class="fixed inset-0 bg-neutral-900/50 dark:bg-neutral-900/70" data-ncmaz-close-modal="ncmaz-modal-form-forgot-password"></div>
        <span class="inline-block h-screen align-middle" aria-hidden="true">
            &#8203;
        </span>
        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
            <!-- CONTENT -->
            <div class="bg-white space-y-6 rounded-2xl text-xs md:text-base text-neutral-700">
                <div class="flex items-center justify-between space-x-3 overflow-hidden">
                    <h4 class="truncate text-xl font-semibold">
                        <?php echo esc_html__('Find Your Account', 'ncmaz'); ?>
                    </h4>
                    <button class="flex p-2 rounded-full hover:bg-neutral-100 focus:outline-none bg-white bg-opacity-10" type="button" data-ncmaz-close-modal="ncmaz-modal-form-forgot-password">
                        <span class="sr-only">
                            <?php echo esc_html__('Dissmis', 'ncmaz'); ?>
                        </span>
                        <svg class="h-6 w-6 text-neutral-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>

                <!-- DIVIDER -->
                <div class="border-t border-neutral-200 pb-2"></div>

                <!-- FORM -->
                <div class="p-0 space-y-6 text-sm">
                    <form id="ncmaz_forgotpasswordform_modal" name="lostpasswordform" class="space-y-6" method="POST" action="<?php echo esc_url(wp_lostpassword_url(get_permalink())); ?>">
                        <div class="ncmaz-input relative">
                            <div class="absolute left-1 top-1/2 transform -translate-y-1/2">
                                <div class="text-[1.375rem] text-neutral-700 px-4 leading-none"><i class="las la-user"></i></div>
                            </div>
                            <input required name="user_login" class="px-5 h-14 w-full border-2 !border-neutral-200/80 rounded-full placeholder-neutral-500 !bg-transparent text-sm pl-14 focus:border-primary focus:ring-0 font-medium" type="text" aria-label="<?php echo esc_attr__('Username or email', 'ncmaz'); ?>" placeholder="<?php echo esc_attr__('Username or email', 'ncmaz'); ?>">
                        </div>
                        <input type="hidden" name="redirect_to" value="">

                        <button type="submit" name="wp-submit" class="ncmaz-button g-recaptcha rounded-full h-14 w-full text-sm xl:text-base inline-flex items-center justify-center text-center py-2 px-4 md:px-6 bg-primary-6000 hover:bg-primary-700 text-neutral-50  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-6000 dark:focus:ring-offset-0 font-medium" data-sitekey="<?php echo esc_attr($enableRecaptcha ? $recaptcha_site_key : ""); ?>" data-callback='ncmaz_onSubmitForgotPasswordForm' data-action='submit'>
                            <?php echo esc_html__('Get new password', 'ncmaz'); ?>
                        </button>

                    </form>
                    <div class="text-center text-sm">
                        <button class="hover:underline text-primary-6000 focus:outline-none" type="button" data-ncmaz-close-modal="ncmaz-modal-form-forgot-password" data-ncmaz-open-modal="ncmaz-modal-form-sign-in">
                            <?php echo esc_html__('Sign in', 'ncmaz'); ?>
                        </button>
                        <?php if ($enableSignUp) : ?>
                            <span class="mx-3">•</span>
                            <button class="hover:underline text-primary-6000 focus:outline-none" type="button" data-ncmaz-close-modal="ncmaz-modal-form-forgot-password" data-ncmaz-open-modal="ncmaz-modal-form-sign-up">
                                <?php echo esc_html__('Sign up', 'ncmaz'); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>