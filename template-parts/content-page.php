<?php

$pageClasses = "entry-content prose prose-neutral !max-w-screen-md lg:prose-lg mx-auto dark:prose-invert entry-content--not-has-sidebar";

if (class_exists('Woocommerce') && function_exists('is_cart') && function_exists('is_account_page') && function_exists('is_checkout')) {
	if (is_checkout() || is_cart() || is_account_page()) {
		$pageClasses = "entry-content ";
	}
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="ncmaz-single-entry-content" class="<?php echo esc_attr($pageClasses); ?>">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ncmaz'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		// ECHO CLEAR BOTH
		echo '<div class="clear-both"></div>';

		wp_link_pages(
			array(
				'before' => '<div class="page-links mt-10">',
				'after'  => '</div>',
			)
		);
		?>
		<div class="clear-both"></div>
	</div>
	<div class="clear-both"></div>


	<!-- COMMENTS -->
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if (comments_open() || get_comments_number()) :
		comments_template();
	endif;
	?>

</article><!-- #post-<?php the_ID(); ?> -->