<?php

add_action('woocommerce_before_single_product', 'ncmaz_single_product_before', 5);
add_action('woocommerce_after_single_product', 'nc_single_product_after', 25);
add_action('woocommerce_before_single_product_summary', 'nc_single_product_image_before', 1);
add_action('woocommerce_before_single_product_summary', 'nc_single_product_summary_before', 100);
add_action('woocommerce_after_single_product_summary', 'nc_single_product_summary_after', 1);

// 
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart ', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);

add_action('woocommerce_before_main_content', 'nc_wc_shop_open_div', 5);
add_action('woocommerce_after_main_content', 'nc_wc_shop_close_div', 50);

add_action('woocommerce_before_shop_loop', 'nc_wc_shop_orderby_open_div', 11);
add_action('woocommerce_before_shop_loop', 'nc_wc_shop_orderby_close_div', 40);

add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 20);
add_action('woocommerce_before_shop_loop_item_title', 'nc_wc_thumbnail_product_open_div', 5);
add_action('woocommerce_before_shop_loop_item_title', 'nc_wc_thumbnail_product_add_to_cart_open_div', 20);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 30);
add_action('woocommerce_before_shop_loop_item_title', 'nc_wc_thumbnail_product_close_div', 50);
add_action('woocommerce_shop_loop_item_title', 'nc_wc_content_product_open_div', 5);
add_action('woocommerce_after_shop_loop_item_title', 'nc_wc_content_product_close_wrap', 6);
add_action('woocommerce_after_shop_loop_item_title', 'nc_wc_content_product_close_div', 20);

add_action('woocommerce_cart_is_empty', 'nc_wc_empty_cart_message_div', 5);

add_action('woocommerce_checkout_order_review', 'nc_wc_checkout_order_review_add_h3', 1);

add_filter('woocommerce_add_to_cart_fragments', 'pixwell_wc_add_to_cart_fragments', 10);
// 

/** mini cart ajax */
if (!function_exists('pixwell_wc_add_to_cart_fragments')) {
	function pixwell_wc_add_to_cart_fragments($fragments)
	{
		ob_start(); ?>
		<span class="cart-counter rb-counter"><?php echo sprintf('%d', WC()->cart->cart_contents_count); ?></span>
	<?php
		$fragments['.cart-icon .cart-counter'] = ob_get_clean();

		$mini_cart = $fragments['div.widget_shopping_cart_content'];
		unset($fragments['div.widget_shopping_cart_content']);
		$fragments['div.mini-cart-wrap'] = '<div class="mini-cart-wrap woocommerce">' . $mini_cart . '</div>';

		return $fragments;
	}
}

if (!function_exists('nc_wc_checkout_order_review_add_h3')) {
	function nc_wc_checkout_order_review_add_h3()
	{
		echo '<h3 id="nc_order_review_heading">' . esc_html__('Your order', 'woocommerce') . '</h3>';
	}
}

if (!function_exists('nc_wc_empty_cart_message_div')) {
	function nc_wc_empty_cart_message_div()
	{
		$emptyCartAlertProps = (object)[];
		$emptyCartAlertProps->type = "info";
		$emptyCartAlertProps->children = esc_html__('Your cart is currently empty.', 'ncmaz');
		echo '<div class="nc_wc_empty_cart_message_div" data-is-react-component="Alert" data-component-props="' .  esc_attr(json_encode($emptyCartAlertProps)) . '"></div>';
	}
}

// 
if (!function_exists('nc_wc_thumbnail_product_open_div')) {
	function nc_wc_thumbnail_product_open_div()
	{
		echo '<div class="nc_wc_thumbnail_product_open_div relative">';
	}
}

if (!function_exists('nc_wc_thumbnail_product_add_to_cart_open_div')) {
	function nc_wc_thumbnail_product_add_to_cart_open_div()
	{
		echo '<div class="nc_wc_thumbnail_product_add_to_cart_open_div">';
	}
}

if (!function_exists('nc_wc_thumbnail_product_close_div')) {
	function nc_wc_thumbnail_product_close_div()
	{
		echo '</div></div>';
	}
}

if (!function_exists('nc_wc_content_product_open_div')) {
	function nc_wc_content_product_open_div()
	{
		echo '<div class="nc_wc_content_product_open_div flex justify-between space-x-2.5 mt-4"><div class="flex flex-col-reverse space-y-reverse space-y-1.5">';
	}
}

if (!function_exists('nc_wc_content_product_close_wrap')) {
	function nc_wc_content_product_close_wrap()
	{
		echo '</div>';
	}
}

if (!function_exists('nc_wc_content_product_close_div')) {
	function nc_wc_content_product_close_div()
	{
		echo '</div>';
	}
}

if (!function_exists('nc_wc_shop_orderby_open_div')) {
	function nc_wc_shop_orderby_open_div()
	{
		echo '<div class="nc_wc_shop_orderby_open_div flex justify-between space-x-2.5">';
	}
}

if (!function_exists('nc_wc_shop_orderby_close_div')) {
	function nc_wc_shop_orderby_close_div()
	{
		echo '</div>';
	}
}

if (!function_exists('nc_wc_shop_open_div')) {
	function nc_wc_shop_open_div()
	{
		echo '<div class="nc_wc_shop_open_div border-t border-neutral-200 dark:border-neutral-700 py-10 sm:py-16"><div class="container">';
	}
}

if (!function_exists('nc_wc_shop_close_div')) {
	function nc_wc_shop_close_div()
	{
		echo '</div></div>';
	}
}






// PIXWELL CODES ====================================================================================================
/**
 * before product page
 */
if (!function_exists('ncmaz_single_product_before')) :
	function ncmaz_single_product_before()
	{
	?>
		<div class="single-product-wrap clearfix">
		<?php
	}
endif;

/*
 * after product page
 */
if (!function_exists('nc_single_product_after')) :
	function nc_single_product_after()
	{
		?>
		</div>
	<?php
	}
endif;



if (!function_exists('pixwell_loop_add_to_cart_wrapper')) :
	function pixwell_loop_add_to_cart_wrapper($content)
	{
		return '<div class="add-to-cart">' . $content . '</div>';
	}
endif;


if (!function_exists('pixwell_buttons_wrapper_open')) :
	function pixwell_buttons_wrapper_open()
	{
		echo '<div class="product-buttons cart-tooltips">';
	}
endif;


if (!function_exists('pixwell_buttons_wrapper_close')) :
	function pixwell_buttons_wrapper_close()
	{
		echo '</div>';
	}
endif;


if (!function_exists('pixwell_loop_product_title')) :
	function pixwell_loop_product_title()
	{
	?>
		<h2 class="woocommerce-loop-product__title h4">
			<a href="<?php echo get_the_permalink(); ?>" class="woocommerce-loop-product-link p-url"><?php the_title(); ?></a>
		</h2>
	<?php
	}
endif;

if (!function_exists('pixwell_loop_product_thumbnail')) :
	function pixwell_loop_product_thumbnail()
	{
	?>
		<a href="<?php echo get_the_permalink(); ?>" class="woocommerce-loop-product-link"> <?php echo woocommerce_get_product_thumbnail(); ?></a>
	<?php
	}
endif;


if (!function_exists('pixwell_checkout_customer_details_before')) :
	function pixwell_checkout_customer_details_before()
	{
	?>
		<div class="checkout-col col-left">
		<?php
	}
endif;

if (!function_exists('pixwell_checkout_customer_details_after')) :
	function pixwell_checkout_customer_details_after()
	{
		?>
		</div>
		<div class="checkout-col col-right">
		<?php
	}

endif;


if (!function_exists('pixwell_checkout_order_after')) :
	function pixwell_checkout_order_after()
	{
		?>
		</div>
	<?php
	}
endif;

if (!function_exists('pixwell_cart_after')) :
	function pixwell_cart_after()
	{
	?>
		<div class="clearfix"></div>
	<?php
	}
endif;


/** single product */
if (!function_exists('nc_single_product_image_before')) :
	function nc_single_product_image_before()
	{
	?>
		<div class="rb-row single-product-content">
			<div class="wc-single-featured">
			<?php
		}
	endif;

	/** before summary */
	if (!function_exists('nc_single_product_summary_before')) :
		function nc_single_product_summary_before()
		{
			?>
			</div>
		<?php
		}
	endif;

	/** after summary */
	if (!function_exists('nc_single_product_summary_after')) :
		function nc_single_product_summary_after()
		{
		?>
		</div>
<?php
		}
	endif;
