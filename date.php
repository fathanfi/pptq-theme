<?php
get_header();
?>

<main class="nc-PageArchiveDate">
	<!-- MY PAGE CONTENT -->
	<?php if (defined('_NCMAZ_FRONTEND_PREFIX')) : ?>
		<?php
		global $ncmaz_redux_demo;

		$enableSidebar = ncmaz__is_enabled($ncmaz_redux_demo["nc-archive-page-settings--sidebar"] ?? false) && is_active_sidebar('archive-page-sidebar');


		// 
		$PageArchiveDateProps = (object)[];
		$PageArchiveDateProps->day 		=  get_query_var('day');
		$PageArchiveDateProps->monthnum =  get_query_var('monthnum');
		$PageArchiveDateProps->year 	=  get_query_var('year');
		// 
		$PageArchiveDateProps->pageTitle 	=  get_the_archive_title();
		$PageArchiveDateProps->enableSidebar 	=  $enableSidebar;
		// 

		?>



		<div class="nc-PageArchiveDate__content space-y-16 lg:space-y-24">
			<div class="container flex flex-col xl:flex-row <?php echo esc_attr($enableSidebar ? "xl:!px-2 xl:max-w-screen-2xl" : "container"); ?>  ">

				<div class="nc-PageArchiveDate__grid flex-1 pt-16 lg:pt-28" data-is-react-component="PageArchiveDate" data-component-props="<?php echo esc_attr(json_encode($PageArchiveDateProps)); ?>"></div>

				<?php if ($enableSidebar) : ?>
					<div class="nc-PageArchiveDate__sidebar space-y-7 w-full xl:w-[30%] mt-12 xl:mt-8 xl:pl-8">
						<?php dynamic_sidebar('archive-page-sidebar'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="nc-PageArchiveDate__SectionTrendingCategories container" data-is-react-component="SectionTrendingCategories" data-component-props="<?php echo esc_attr(json_encode(ncmazGetOptionForSectionTrendingArchivePage())); ?>"></div>
		</div>

	<?php else : ?>

		<!-- DEFAULT PAGE CONTENT -->
		<?php get_template_part('template-parts/archive-common'); ?>
	<?php endif; ?>

</main>

<?php
get_footer();
