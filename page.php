<?php
get_header();

$pageNcmazAccountPostSubmission = null;
if (function_exists('checkPageNcmazAccountOrPostSubmissionEditor')) {
	$pageNcmazAccountPostSubmission = checkPageNcmazAccountOrPostSubmissionEditor($post->ID);
}
?>

<?php if ($pageNcmazAccountPostSubmission === "pagePostSubmissionEditorUrl") : ?>
	<?php get_template_part('template-parts/content-page-ncmaz-submission-post-editor'); ?>
<?php elseif ($pageNcmazAccountPostSubmission === "pageNcmazAccountUrl") : ?>
	<?php get_template_part('template-parts/content-page-ncmaz-account'); ?>
<?php else : ?>
	<main id="primary" class="nc-PageSingleTemplate2 pt-8 lg:pt-16 ">
		<?php
		while (have_posts()) :
			the_post();
		?>
			<header class="entry-header container entry-header--style-1">
				<div class="max-w-screen-md mx-auto">
					<?php the_title('<h1 class="entry-title text-neutral-900 font-semibold text-3xl md:text-4xl md:!leading-[120%] lg:text-5xl dark:text-neutral-100 max-w-4xl ">', '</h1>') ?>
				</div>
			</header>

			<!-- // ENTRY CONTENT -->
			<div class="container my-10 ">
				<?php get_template_part('template-parts/content-page'); ?>
			</div>
		<?php
		endwhile; // End of the loop.
		?>

	</main>

<?php endif; ?>


<?php

// -------------------- UPDATE COUNT VIEW --------------------
if (is_single() && function_exists('ncmazFe_checkEnableCountViewFeature')) {
	if (ncmazFe_checkEnableCountViewFeature()) {
		ncmaz_update_count_views(get_the_ID());
	}
}
// FOOTER
get_footer();
