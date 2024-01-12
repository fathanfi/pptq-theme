<?php
$hasWidget = is_active_sidebar('footer-1-sidebar') || is_active_sidebar('footer-2-sidebar') || is_active_sidebar('footer-3-sidebar') || is_active_sidebar('footer-4-sidebar');
?>

<!-- ADD UNIQUE ID WHEN ACTIVE WOOCOMMERCE -->
<?php if (class_exists('WooCommerce')) : ?>
	<div id="nc_Woocommerce_Actived" class="hidden"></div>
<?php endif; ?>

<footer id="colophon" class="nc-Footer relative border-t border-neutral-200 dark:border-neutral-700 <?php echo esc_attr($hasWidget ? " py-16 lg:py-24 " : "  "); ?>">
	<?php if ($hasWidget) : ?>
		<div class="container text-sm sm:flex space-y-8 sm:space-y-0">
			<div class="flex sm:block lg:flex flex-1 sm:space-y-8 lg:space-y-0">
				<!-- WIDGET 1 -->
				<?php if (is_active_sidebar('footer-1-sidebar')) : ?>
					<div class="nc-Footer-item flex-1">
						<?php dynamic_sidebar('footer-1-sidebar'); ?>
					</div>
				<?php endif; ?>

				<!-- WIDGET 2 -->
				<?php if (is_active_sidebar('footer-2-sidebar')) : ?>
					<div class="nc-Footer-item flex-1">
						<?php dynamic_sidebar('footer-2-sidebar'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="lg:flex space-y-8 lg:space-y-0 <?php echo esc_attr(is_active_sidebar('footer-3-sidebar') ?  "flex-[1.5]" : "flex-1") ?> ">
				<!-- WIDGET 3 -->
				<?php if (is_active_sidebar('footer-3-sidebar')) : ?>
					<div class="nc-Footer-item flex-1">
						<?php dynamic_sidebar('footer-3-sidebar'); ?>
					</div>
				<?php endif; ?>

				<!-- WIDGET 4 -->
				<?php if (is_active_sidebar('footer-4-sidebar')) : ?>
					<div class="nc-Footer-item flex-[2] flex-shrink-0">
						<?php dynamic_sidebar('footer-4-sidebar'); ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
	<?php endif; ?>
</footer>

<!-- MOBILE MENU MODAL -->
<?php get_template_part('template-parts/header/mobile-nav'); ?>

<!-- SIGNIN/SIGNUP MODAL -->
<?php if (defined('_NCMAZ_FRONTEND_VERSION')) : ?>
	<?php get_template_part('template-parts/footer/footer-modal-form-sign-up'); ?>
	<?php get_template_part('template-parts/footer/footer-modal-form-sign-in'); ?>
	<?php get_template_part('template-parts/footer/footer-modal-form-forgot-password'); ?>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>