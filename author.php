<?php
get_header();
?>

<main class="nc-PageArchiveAuthor" id="nc-page-author-id">
	<!-- MY PAGE CONTENT -->
	<?php if (defined('_NCMAZ_FRONTEND_VERSION') && function_exists('graphql')) : ?>
		<?php
		global $ncmaz_redux_demo;

		$enableSidebar = ncmaz__is_enabled($ncmaz_redux_demo["nc-archive-page-settings--sidebar"] ?? false) && is_active_sidebar('archive-page-sidebar');


		$ncmaz_frontend_version_int = ncmazTheme_string_version_toInt(_NCMAZ_FRONTEND_VERSION);

		$PageArchiveDateProps = (object)[];
		$HeaderPageArchiveAuthorProps = (object)[];
		$userId = get_queried_object_id();

		$PageArchiveDateProps->userId = $userId;
		$IS_CURRENT_MY_PAGE = boolval(get_current_user_id() === $userId);
		// NEU KHONG PHAI TRANG CUA MINH THI GET DATA
		// NEU KHONG THI CURRENT-USER-DATA CO SAN TRONG FRONTEND-OBJECT
		if (empty($IS_CURRENT_MY_PAGE) || $ncmaz_frontend_version_int < 413) {
			$userGraphql = graphql([
				'query' => '{
					user(id: "' . get_queried_object_id() . '", idType: DATABASE_ID) {
						id
						avatar {
						  url
						}
						name
						username
						userId
						url
						uri
						description
						ncUserMeta {
						  color
						  ncBio
						  youtubeUrl
						  facebookUrl
						  mediumUrl
						  githubUrl
						  vimeoUrl
						  twitterUrl
						  instagramUrl
						  linkedinUrl
						  pinterestUrl
						  twitchUrl
						  websiteUrl
						  buymeacoffeUrl
						  backgroundImage {
							id
							altText
							caption
							databaseId
							sizes
							sourceUrl
							srcSet
						  }
						  featuredImage {
							id
							altText
							caption
							databaseId
							sizes
							sourceUrl
							srcSet
						  }
						}
					}
				}'
			]);

			$HeaderPageArchiveAuthorProps->userData =  $userGraphql['data']['user'];
		}

		$PageArchiveDateProps->isCurrentMyPage = $IS_CURRENT_MY_PAGE;
		$HeaderPageArchiveAuthorProps->isCurrentMyPage = $IS_CURRENT_MY_PAGE;

		if (function_exists('get_clear_favorites_button')) {
			$HeaderPageArchiveAuthorProps->clearFavoritesButton = get_clear_favorites_button($site_id = null, $text = null);
		}
		// KHI TRANG CUA AUTHOR KHAC
		if (function_exists('get_user_favorites') && function_exists('get_user_favorites_count')) {
			if (boolval(get_user_favorites_count($user_id = $userId))) {
				$PageArchiveDateProps->listIDFavorites = get_user_favorites($user_id = $userId, $site_id = null, $filters = null);
			} else {
				$PageArchiveDateProps->listIDFavorites  = (object)[];
			}
		}

		// 
		$PageArchiveDateProps->enableSidebar = $enableSidebar;
		?>

		<div class="nc-PageArchiveAuthor__header w-full" data-is-react-component="HeaderPageArchiveAuthor" data-component-props="<?php echo esc_attr(json_encode($HeaderPageArchiveAuthorProps)); ?>"></div>

		<div class="nc-PageArchiveAuthor__content py-16 lg:pb-24 lg:pt-20 space-y-16 lg:space-y-24">

			<div class="container flex flex-col xl:flex-row <?php echo esc_attr($enableSidebar ? "xl:!px-2 xl:max-w-screen-2xl" : "container"); ?>  ">

				<div class="nc-PageArchiveAuthor__grid flex-1" data-is-react-component="PageArchiveAuthor" data-component-props="<?php echo esc_attr(json_encode($PageArchiveDateProps)); ?>"></div>

				<?php if ($enableSidebar) : ?>
					<div class="nc-PageArchiveAuthor__sidebar space-y-7 w-full xl:w-[30%] mt-12 xl:mt-0 xl:pl-8">
						<?php dynamic_sidebar('archive-page-sidebar'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="nc-PageArchiveAuthor__SectionTrendingCategories container" data-is-react-component="SectionTrendingCategories" data-component-props="<?php echo esc_attr(json_encode(ncmazGetOptionForSectionTrendingArchivePage())); ?>"></div>
		</div>

	<?php else : ?>
		<?php get_template_part('template-parts/archive-common'); 	?>
	<?php endif; ?>
</main>

<?php
get_footer();
