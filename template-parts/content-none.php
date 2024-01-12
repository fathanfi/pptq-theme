<section class="no-results not-found">
	<header class="page-header mb-5">
		<h1 class="page-title entry-title text-neutral-900 font-semibold text-3xl md:text-4xl md:!leading-[120%] lg:text-5xl dark:text-neutral-100 max-w-4xl">
			<?php esc_html_e('Nothing Found', 'ncmaz'); ?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content space-y-10">
		<?php
		if (is_home() && current_user_can('publish_posts')) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ncmaz'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);

		elseif (is_search()) :
		?>
			<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ncmaz'); ?></p>
		<?php
			get_search_form();
		else :
		?>
			<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ncmaz'); ?></p>
		<?php
			get_search_form();
		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->