<?php
get_header();
global $ncmaz_redux_demo;
$singlePageTypeOnThemeOptions = '2'; // 1 | 2 | 3 | 1_required | 2_required | 2_required
$singlePageType = '2'; // 1 | 2 | 3 | by_theme_options
$enableSidebar = is_active_sidebar('single-sidebar');

$postFormat = get_post_format();
if (defined('_NCMAZ_FRONTEND_VERSION') && function_exists('get_field')) {
	$singlePageType = get_field('single_page_style');
	$enableSidebar = is_active_sidebar('single-sidebar') && get_field('show_right_sidebar');
	if (!empty($ncmaz_redux_demo)) {
		$singlePageTypeOnThemeOptions = $ncmaz_redux_demo['nc-single-page-settings--general-single-stype-opt'] ?? '2';
		if ($ncmaz_redux_demo['nc-single-page-settings--general-single-widget-opt'] === 'enable') {
			$enableSidebar = is_active_sidebar('single-sidebar');
		}
		if ($ncmaz_redux_demo['nc-single-page-settings--general-single-widget-opt'] === 'disable') {
			$enableSidebar = false;
		}
	}
}


// 
// 
if ($singlePageType == "by_theme_options") {
	$singlePageType = $singlePageTypeOnThemeOptions;
}

if ($singlePageTypeOnThemeOptions == "1_required") {
	$singlePageType = '1';
} elseif ($singlePageTypeOnThemeOptions == "2_required") {
	$singlePageType = '2';
} elseif ($singlePageTypeOnThemeOptions == "3_required") {
	$singlePageType = '3';
}
// 
// 

$mainClasses = "pt-8 lg:pt-14 ";
if ($postFormat === 'video') {
	$mainClasses = "nc-PageSingleTemplateVideo ";
}

if ($singlePageType === '3') {
	$mainClasses = "nc-PageSingleTemplate3 ";
}
?>

<main id="primary" class="nc-PageSingleTemplate2 relative <?php echo esc_attr($mainClasses); ?>">

	<?php
	while (have_posts()) :
		the_post();

		if (defined('_NCMAZ_FRONTEND_VERSION')) {
			if ($postFormat === 'gallery') {
				get_template_part('template-parts/single-header/single-header-gallery');
			} else if ($postFormat === 'video') {
				get_template_part('template-parts/single-header/single-header-video');
			} else if ($postFormat === 'audio') {
				get_template_part('template-parts/single-header/single-header-audio');
			} else {
				if (!$enableSidebar) {
					// ============== HEADER ==============
					if ($singlePageType == '1') {
						get_template_part('template-parts/single-header/single-header-1');
					} else if ($singlePageType == '2') {
						get_template_part('template-parts/single-header/single-header-2', null, ['has_sidebar' => false]);
					} else if ($singlePageType == '3') {
						get_template_part('template-parts/single-header/single-header-3');
					} else {
						get_template_part('template-parts/single-header/single-header-1');
					}
				} else {
					if ($singlePageType == '3') {
						get_template_part('template-parts/single-header/single-header-3');
					} else {
						get_template_part('template-parts/single-header/single-header-2', null, ['has_sidebar' => true]);
					}
				}
			}
		} else {
			get_template_part('template-parts/single-header/single-header-2', null, ['has_sidebar' => $enableSidebar]);
		}


		// ENTRY CONTENT
		echo '<div class="container my-10 ' . esc_html($enableSidebar ? "flex flex-col lg:flex-row" : "") . '">';
		if ($enableSidebar) : ?>
			<div class="w-full lg:w-3/5 xl:w-2/3 xl:pr-20">
				<?php get_template_part('template-parts/content', get_post_type(), ['has_sidebar' => $enableSidebar]); ?>
			</div>
			<div class="w-full mt-12 lg:mt-0 lg:w-2/5 lg:pl-10 xl:pl-0 xl:w-1/3 space-y-7">
				<?php dynamic_sidebar('single-sidebar'); ?>
			</div>
		<?php else : ?>
			<?php get_template_part('template-parts/content', get_post_type(),  ['has_sidebar' => $enableSidebar]); ?>
	<?php endif;
		echo '</div>';


		// RELATED POSTS
		get_template_part('template-parts/single-page/single-related-posts', get_post_type());

	endwhile; // End of the loop.
	?>



</main>

<?php

// -------------------- UPDATE COUNT VIEW --------------------
if (is_single() && function_exists('ncmazFe_checkEnableCountViewFeature')) {
	if (ncmazFe_checkEnableCountViewFeature()) {
		ncmaz_update_count_views(get_the_ID());
	}
}

get_footer();
