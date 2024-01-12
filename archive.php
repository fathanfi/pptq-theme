<?php
get_header();

?>

<main class="nc-PageArchive">
	<!-- MY PAGE CONTENT -->
	<?php if (defined('_NCMAZ_FRONTEND_PREFIX') && function_exists('graphql') && function_exists('get_field')) : ?>
		<?php
		$termNodeCommon =  'id
		count
		databaseId
		description
		link
		name
		slug
		termTaxonomyId
		ncTaxonomyMeta {
		  color
		  featuredImage {
			id
            altText
            caption
            databaseId
            sizes
            sourceUrl
            srcSet
		  }
		}';

		$graphql = graphql([
			'query' => ' { 
				termNode(id: ' . get_queried_object_id() . ', idType: DATABASE_ID) {
					... on Category {' . $termNodeCommon . '}
					... on Tag {' . $termNodeCommon . '}
					... on PostFormat {' . $termNodeCommon . '}
			  }
			}'
		]);

		$termData = $graphql['data']['termNode'] ?? null;
		if (empty($termData)) {
			return '';
		}

		global $ncmaz_redux_demo;

		$enableSidebar = ncmaz__is_enabled($ncmaz_redux_demo["nc-archive-page-settings--sidebar"] ?? false) && is_active_sidebar('archive-page-sidebar');


		$PageArchiveProps = (object)[];
		$PageArchiveProps->termId = get_queried_object_id();
		$PageArchiveProps->isTag = is_tag();
		$PageArchiveProps->enableSidebar = $enableSidebar;

		$archivePageCoverImgDefault = $ncmaz_redux_demo['nc-archive-page-settings--archivePageCoverImgDefault']["url"] ?? "";


		?>

		<div class="nc-PageArchive__header w-full px-2 xl:max-w-screen-2xl mx-auto mt-4 sm:mt-7">
			<div class="rounded-3xl relative aspect-w-16 aspect-h-12 sm:aspect-h-8 lg:aspect-h-7 xl:aspect-h-5 overflow-hidden ">
				<img class="object-cover" src="<?php echo esc_attr($termData["ncTaxonomyMeta"]["featuredImage"]["sourceUrl"] ?? $archivePageCoverImgDefault) ?>" alt="<?php echo esc_attr__("archive hero image", "ncmaz"); ?>" sizes="(max-width: 1536px) 100vw, 1536px" srcset="<?php echo esc_attr($termData["ncTaxonomyMeta"]["featuredImage"]["srcSet"] ?? ""); ?>">

				<div class="absolute inset-0 bg-black text-white bg-opacity-30 flex flex-col items-center justify-center text-center">
					<h1 class="inline-block align-middle text-4xl sm:text-5xl font-semibold md:text-7xl">
						<?php echo (is_tag() ? "#" : ""); ?>
						<?php echo $termData["name"]; ?>
					</h1>
					<?php if (!empty($termData["description"] ?? "")) : ?>
						<div class="hidden md:block max-w-xl text-sm mt-3 text-white">
							<?php echo ($termData['description'] ?? ""); ?>
						</div>
					<?php endif; ?>

					<span class="block mt-2 sm:mt-4 text-neutral-200">
						<?php echo ($termData["count"] ?? 0); ?>
						<?php echo esc_html__("articles", "ncmaz"); ?>
					</span>
				</div>
			</div>
		</div>

		<?php if (!empty($termData["description"] ?? "")) : ?>
			<div class="container block md:hidden max-w-xl text-sm mt-4 text-neutral-500 dark:text-neutral-300">
				<?php echo ($termData['description'] ?? ""); ?>
			</div>
		<?php endif; ?>

		<div class="nc-PageArchive__content py-16 lg:pb-24 space-y-16 lg:space-y-24">

			<div class="container flex flex-col xl:flex-row <?php echo esc_attr($enableSidebar ? "xl:!px-2 xl:max-w-screen-2xl" : "container"); ?>  ">
				<div class="nc-PageArchive__grid flex-1" data-is-react-component="PageArchive" data-component-props="<?php echo esc_attr(json_encode($PageArchiveProps)); ?>"></div>

				<?php if ($enableSidebar) : ?>
					<div class="nc-PageArchive__sidebar space-y-7 w-full xl:w-[30%] mt-12 xl:mt-0 xl:pl-8">
						<?php dynamic_sidebar('archive-page-sidebar'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="nc-PageArchive__SectionTrendingCategories container" data-is-react-component="SectionTrendingCategories" data-component-props="<?php echo esc_attr(json_encode(ncmazGetOptionForSectionTrendingArchivePage())); ?>"></div>

		</div>


	<?php else : ?>
		<!-- DEFAULT PAGE CONTENT -->
		<?php get_template_part('template-parts/archive-common'); ?>
	<?php endif; ?>

</main>

<?php
get_footer();
