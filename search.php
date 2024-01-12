<?php

get_header();
?>

<main class="nc-PageSearch nc-PageArchiveSearch">

	<?php if (defined('_NCMAZ_FRONTEND_VERSION')) : ?>
		<?php
		global $ncmaz_redux_demo;

		$enableSidebar = ncmaz__is_enabled($ncmaz_redux_demo["nc-search-page-settings--sidebar"] ?? false) && is_active_sidebar('archive-page-sidebar');


		// 
		$PageSearchProps = (object)[];
		$PageSearchProps->searchQuery =  get_search_query();
		$PageSearchProps->listSuggestions =  $ncmaz_redux_demo['nc-search-page-settings--multi-text-suggestions'];
		$PageSearchProps->enableSidebar =  $enableSidebar;
		// 
		$headerBackgroundImg =  $ncmaz_redux_demo['nc-search-page-settings--media-background'];
		?>

		<div class="relative aspect-w-16 aspect-h-9 sm:aspect-h-6 lg:aspect-h-5 xl:aspect-h-4 2xl:aspect-h-3">
			<img alt="search page hero" src="<?php echo esc_url($headerBackgroundImg["url"] ?? "https://images.pexels.com/photos/2138922/pexels-photo-2138922.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"); ?>" class="object-cover w-full h-full" sizes="(max-width: 1536px) 100vw, 1536px" />
		</div>

		<div class="nc-PageArchiveSearch__content space-y-16 lg:space-y-24">
			<div class="container flex flex-col xl:flex-row <?php echo esc_attr($enableSidebar ? "xl:!px-2 xl:max-w-screen-2xl" : "container"); ?>  ">

				<div class="nc-PageArchiveSearch__grid flex-1" data-is-react-component="PageSearch" data-component-props="<?php echo esc_attr(json_encode($PageSearchProps)); ?>"></div>

				<?php if ($enableSidebar) : ?>
					<div class="nc-PageArchiveSearch__sidebar space-y-7 w-full xl:w-[30%] mt-12 xl:mt-8 xl:pl-8">
						<?php dynamic_sidebar('archive-page-sidebar'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="nc-PageArchiveSearch__SectionTrendingCategories container" data-is-react-component="SectionTrendingCategories" data-component-props="<?php echo esc_attr(json_encode(ncmazGetOptionForSectionTrendingArchivePage())); ?>"></div>
		</div>

	<?php else : ?>

		<!-- DEFAULT PAGE CONTENT -->
		<div class="container py-16 lg:py-28 space-y-16 lg:space-y-28">
			<?php if (have_posts()) : ?>
				<div>
					<!-- PAGE HEADER -->
					<header class="page-header">
						<h1 class="inline-block max-w-screen-2xl text-4xl font-semibold md:text-5xl">
							<?php
							/* translators: %s: search query. */
							printf(esc_html__('Search Results for: %s', 'ncmaz'), '<span>' . get_search_query() . '</span>'); 	?>
						</h1>
					</header>

					<!-- GRID POSTS -->
					<div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 mt-14">
					<?php
					while (have_posts()) :
						the_post();
						get_template_part('template-parts/components/post-card', null, ['post' => $post]);
					endwhile;

				else :
					get_template_part('template-parts/content', 'none');
				endif; ?>
					</div>
				</div>

				<!-- PAGINATION -->
				<?php if (have_posts()) : ?>
					<div>
						<?php ncmaz_the_posts_navigation(); ?>
					</div>
				<?php endif; ?>
		</div>
	<?php endif; ?>

</main>

<?php
get_footer();
