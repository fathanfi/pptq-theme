<div class="FooterQuickNav z-40 flex-1 w-full block xl:hidden p-2 bg-white dark:bg-neutral-800 border-t border-neutral-300 dark:border-neutral-700 transition-transform duration-300 ease-in-out">
    <div class="w-full max-w-screen-sm lg:max-w-screen-md flex justify-around mx-auto text-2xl text-center ">
        <!-- ICON -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="FooterQuickNav__home flex flex-col items-center justify-between <?php echo esc_attr(is_front_page() ? "text-neutral-900 dark:text-neutral-50" : "text-neutral-500 dark:text-neutral-300/90"); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[10px] leading-none mt-1">
                <?php echo esc_html__('Home', 'ncmaz'); ?>
            </span>
        </a>

        <!-- ICON -->
        <a href="<?php echo esc_url(home_url('/?s=""')); ?>" class="FooterQuickNav__search flex flex-col items-center justify-between <?php echo esc_attr(is_search() ? "text-neutral-900 dark:text-neutral-50" : "text-neutral-500 dark:text-neutral-300/90"); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <span class="text-[10px] leading-none mt-1">
                <?php echo esc_html__('Search', 'ncmaz'); ?>
            </span>
        </a>

        <!-- ICON -->
        <?php get_template_part('template-parts/header/module-cart'); ?>

        <!-- ICON -->
        <button type="button" class="FooterQuickNav__menu btn-toogle-mobile-sidebar-menu flex flex-col items-center justify-between text-neutral-500 dark:text-neutral-300/90 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <span class="text-[10px] leading-none mt-1">
                <?php echo esc_html__('Menu', 'ncmaz'); ?>
            </span>
        </button>
    </div>

</div>