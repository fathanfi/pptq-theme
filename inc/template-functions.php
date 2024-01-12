<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ncmaz
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ncmaz_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'ncmaz_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ncmaz_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'ncmaz_pingback_header');


// 
//  ADD CLASS CUSTOMM TEMPALTE TO ADMIN EDITOR
add_filter('admin_body_class', function ($classes) {
	global $pagenow;
	if ($pagenow === 'post.php' && isset($_GET['post'])) {
		$pageTemplate = get_page_template_slug($_GET['post']);
		if ($pageTemplate === 'page_custom.php') {
			$classes .= ' ncmaz-custom-page ';
			// return ngay de khong chua class ncmmaz-nomal
			return $classes;
		}
	}
	return $classes . ' ncmaz-not-custom-page ';
});

// 
function ncmazTheme_NavAccountDropdownProps_Data()
{
	global $ncmaz_redux_demo;
	$NavAccountDropdownProps = (object)[
		'data'    => [],
		'footData' => []
	];

	if (empty($ncmaz_redux_demo)) {
		return $NavAccountDropdownProps;
	}

	// MENU1: AUTHOR PAGE
	$NavAccountDropdownProps->data[] = [
		'id'    =>    'menu01',
		'name'    =>     __('Author page', 'ncmaz'),
		'icon'    =>     "las la-user-circle text-xl",
		'href'    =>     esc_url(get_author_posts_url(wp_get_current_user()->ID)),
	];

	if (!empty($ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-1']['name'])) {
		$NavAccountDropdownProps->data[] = [
			'id'    =>    'menu1',
			'name'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-1']['name'],
			'icon'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-1']['icon'] . ' text-xl',
			'href'    =>    $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-1']['url'],
		];
	}
	if (!empty($ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-2']['name'])) {
		$NavAccountDropdownProps->data[] = [
			'id'    =>    'menu2',
			'name'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-2']['name'],
			'icon'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-2']['icon'] . ' text-xl',
			'href'    =>    $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-2']['url'],
		];
	}
	if (!empty($ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-3']['name'])) {
		$NavAccountDropdownProps->data[] = [
			'id'    =>    'menu3',
			'name'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-3']['name'],
			'icon'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-3']['icon'] . ' text-xl',
			'href'    =>    $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-3']['url'],
		];
	}
	if (!empty($ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-4']['name'])) {
		$NavAccountDropdownProps->data[] = [
			'id'    =>    'menu4',
			'name'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-4']['name'],
			'icon'    =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-4']['icon'] . ' text-xl',
			'href'    =>    $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-4']['url'],
		];
	}
	// MENU FOOTERS 
	if (!empty($ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-1']['name'])) {
		$NavAccountDropdownProps->footData[] = [
			'id'        =>    'menuFoot1',
			'name'      =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-1']['name'],
			'icon'      =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-1']['icon'] . ' text-xl',
			'href'      =>    $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-1']['url'],
		];
	}
	if (!empty($ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-2']['name'])) {
		$NavAccountDropdownProps->footData[] = [
			'id'        =>    'menuFoot2',
			'name'      =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-2']['name'],
			'icon'      =>     $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-2']['icon'] . ' text-xl',
			'href'      =>    $ncmaz_redux_demo['nc-header-settings--account-dropdown--menu-foot-2']['url'],
		];
	}

	global $wp;
	// MENU FOOTER: LOGOUT
	$NavAccountDropdownProps->footData[] = [
		'id'        =>    'menuFoot3',
		'name'      =>    esc_html__('Logout', 'ncmaz'),
		'icon'      =>     'las la-sign-out-alt text-xl leading-none',
		'href'      =>     wp_logout_url(home_url($wp->request))
	];
	return $NavAccountDropdownProps;
}
