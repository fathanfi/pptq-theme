<?php

global $ncmaz_redux_demo;
/** header mini cart */
if (!class_exists('WooCommerce') || !function_exists('wc_get_cart_url') || empty($ncmaz_redux_demo)) {
	return false;
}

$pixwell_header_cart = boolval($ncmaz_redux_demo['nc-header-settings--general--toggle-mini-cart']);

if (!empty($pixwell_header_cart)) : ?>
	<div class="nc-module-cart">
		<aside class="rb-mini-cart nav-cart is-hover">
			<a class="rb-cart-link cart-link -- relative xl:w-12 xl:h-12 rounded-full xl:text-neutral-700 xl:dark:text-neutral-300 xl:hover:bg-neutral-100 xl:dark:hover:bg-neutral-800 focus:outline-none flex flex-col items-center justify-between xl:justify-center <?php echo esc_attr(is_cart() ? "text-neutral-900 dark:text-neutral-50" : "text-neutral-500 dark:text-neutral-300/90"); ?>" href="<?php echo esc_url(wc_get_cart_url()) ?>" title="<?php echo esc_attr__('view_cart', 'ncmaz'); ?>">
				<span class="cart-icon">
					<svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M16.25 22C16.9404 22 17.5 21.4404 17.5 20.75C17.5 20.0596 16.9404 19.5 16.25 19.5C15.5596 19.5 15 20.0596 15 20.75C15 21.4404 15.5596 22 16.25 22Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M8.25 22C8.94036 22 9.5 21.4404 9.5 20.75C9.5 20.0596 8.94036 19.5 8.25 19.5C7.55964 19.5 7 20.0596 7 20.75C7 21.4404 7.55964 22 8.25 22Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M9 8H21" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					</svg>

					<em class="cart-counter rb-counter">
						<?php echo esc_attr(WC()->cart->cart_contents_count); ?>
					</em>
				</span>
				<span class="block xl:hidden text-[10px] leading-none mt-1">
					<?php echo esc_html__('Cart', 'ncmaz'); ?>
				</span>
			</a>

			<?php if (function_exists('woocommerce_mini_cart')) : ?>
				<div class="nav-mini-cart header-lightbox">
					<div class="mini-cart-wrap">
						<div class="widget_shopping_cart_content">
							<?php woocommerce_mini_cart(); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</aside>
	</div>
<?php endif;
