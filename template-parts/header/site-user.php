<?php global $ncmaz_redux_demo; ?>

<?php if (!empty($ncmaz_redux_demo)) : ?>
    <?php if (!is_user_logged_in()) : ?>
        <?php if (boolval($ncmaz_redux_demo['nc-header-settings--general--toggle-signIn-btn'])) : ?>
            <!-- BUTTON SIGNIN OPEN MODAN SIGN IN -->
            <a data-ncmaz-open-modal="ncmaz-modal-form-sign-in" class="nc-Button ml-3 relative h-auto inline-flex items-center justify-center rounded-full transition-colors text-sm xl:text-base xl:font-medium py-2 px-4 xl:py-3 xl:px-6 ttnc-ButtonPrimary bg-primary-6000 hover:bg-primary-700 text-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-6000 dark:focus:ring-offset-0" href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" alt="<?php esc_attr_e('Login', 'ncmaz'); ?>">
                <?php echo esc_html__('Sign up', 'ncmaz'); ?>
            </a>

        <?php endif;   ?>

    <?php else : ?>
        <?php $NavAccountDropdownProps =  ncmazTheme_NavAccountDropdownProps_Data();  ?>
        <div class="ml-2 xl:ml-0.5" data-is-react-component="NavAccountDropdown" data-component-props="<?php echo esc_attr(json_encode($NavAccountDropdownProps)); ?>"></div>
    <?php endif; ?>
<?php endif; ?>