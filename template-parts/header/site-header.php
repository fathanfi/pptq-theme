<?php
global $ncmaz_redux_demo;
$showToogleDarkmode = false;

if ($ncmaz_redux_demo !== null) {
	$showToogleDarkmode = boolval($ncmaz_redux_demo['nc-general-settings--header-switch-enableDarkmode']);
}

$classes =  'nc-Header top-0 w-full left-0 right-0 z-40 ';
if (defined('_NCMAZ_FRONTEND_VERSION')) {
	$classes = 'sticky nc-Header top-0 w-full left-0 right-0 z-40 transition-all ';
}
?>

<!-- anchorHeaderSite -->
<div id="anchorHeaderSite" className="h-1 absolute invisible"></div>

<!-- HeaderSite -->
<header id="masthead" class="<?php echo esc_attr($classes); ?>">
	<div class="nc-Header__MainNav1 relative z-10">
		<div class="nc-MainNav1 z-10 notOnTop">
			<div class="container">
				<div class="relative flex justify-between space-x-4 xl:space-x-8">
					<div class="flex justify-start flex-1 space-x-4 sm:space-x-6 2xl:space-x-9">
						<?php get_template_part('template-parts/header/site-branding'); ?>
						<?php get_template_part('template-parts/header/site-nav'); ?>
					</div>
					<div class="py-1.5 xl:py-3.5 flex-shrink-0 flex justify-end text-neutral-700 dark:text-neutral-100">
						<?php if (defined('_NCMAZ_FRONTEND_VERSION')) : ?>
							<!-- DARK MODE ICON -->
							<?php if ($showToogleDarkmode) : ?>
								<?php
								$SwitchDarkModeProps = (object)[];
								$SwitchDarkModeProps->className = "h-10 w-10 xl:w-12 xl:h-12"
								?>
								<div class="block" data-is-react-component="SwitchDarkMode" data-component-props="<?php echo esc_attr(json_encode($SwitchDarkModeProps)); ?>"></div>
							<?php endif; ?>

							<!-- SEARCH ICON -->
							<div class="hidden xl:block">
								<div data-is-react-component="SearchDropdown"></div>
							</div>
							<!-- WOOCOMMERCE ICON CART -->
							<div class="hidden xl:block">
								<?php get_template_part('template-parts/header/module-cart'); ?>
							</div>
							<!-- USER ICON -->
							<?php get_template_part('template-parts/header/site-user'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- SINGLE HEADER & SCROLL BAR -->
	<?php if (defined('_NCMAZ_FRONTEND_VERSION')) : ?>
		<?php if (is_single() && is_singular()) : ?>
			<?php if (!class_exists('Woocommerce') || !function_exists('wc_get_cart_url') || !function_exists('is_product') || !is_product()) : ?>
				<div class="nc-SingleHeaderMenu dark text-white py-2.5 bg-neutral-900 dark:bg-neutral-900 transition-all absolute inset-x-0 [ -z-50 opacity-0 invisible ]">
					<div class="container">
						<div class="flex justify-end lg:justify-between">

							<div class="hidden lg:flex items-center mr-3 overflow-hidden">
								<a class="flex items-center space-x-2" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
									<div class="wil-avatar relative flex-shrink-0 inline-flex items-center justify-center overflow-hidden text-neutral-100 uppercase font-semibold  rounded-full shadow-inner h-10 w-10 sm:h-11 sm:w-11 text-xl ring-1 ring-white dark:ring-neutral-900">
										<img loading="lazy" class="absolute inset-0 w-full h-full object-cover " src="<?php echo esc_url(getAuthorImgUrlById($post->post_author)); ?>" alt="<?php echo esc_attr(get_the_author()); ?>">
									</div>
								</a>
								<h3 class="ml-4 text-lg line-clamp-1 text-neutral-100">
									<?php the_title(); ?>
								</h3>
							</div>

							<?php get_template_part('template-parts/single-header/single-header-meta-area'); ?>
						</div>
					</div>
					<div class="nc-SingleHeaderMenu__progress-container absolute top-full left-0 w-full progress-container h-[5px] bg-neutral-300 overflow-hidden">
						<div class="nc-SingleHeaderMenu__progress-bar progress-bar h-[5px] w-0 bg-teal-600"></div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>

</header>

<!-- FOOTER NAV -->
<div id="nc-footer-fixed-area" class="fixed bottom-0 inset-x-0 flex flex-col-reverse z-40">
	<?php get_template_part('template-parts/header/site-footer-quick-nav'); ?>
</div>