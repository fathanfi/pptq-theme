<?php
get_header();
?>

<main id="primary" class="nc-PageArchive nc-PageArchive--author">
	<!-- MY PAGE CONTENT -->
	<?php if (defined('_NCMAZ_FRONTEND_VERSION') && function_exists('graphql')) : ?>
		<?php
		$ncmaz_frontend_version_int = ncmazTheme_string_version_toInt(_NCMAZ_FRONTEND_VERSION);

		$PageArchiveDateProps = (object)[];
		$IS_CURRENT_MY_PAGE = boolval(get_current_user_id() === get_queried_object_id());
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
			$PageArchiveDateProps->userData =  $userGraphql['data']['user'];
		}

		$PageArchiveDateProps->isCurrentMyPage = $IS_CURRENT_MY_PAGE;
		$PageArchiveDateProps->clearFavoritesButton = get_clear_favorites_button($site_id = null, $text = null);
		// KHI TRANG CUA AUTHOR KHAC
		if (empty($IS_CURRENT_MY_PAGE) && function_exists('get_user_favorites') && function_exists('get_user_favorites_count')) {
			if (boolval(get_user_favorites_count($user_id = get_queried_object_id()))) {
				$PageArchiveDateProps->listIDFavorites = get_user_favorites($user_id = get_queried_object_id(), $site_id = null, $filters = null);
			} else {
				$PageArchiveDateProps->listIDFavorites  = (object)[];
			}
		}

		// 
		$PageArchiveDateProps->sectionCategoriesTrending = ncmazGetOptionForSectionTrendingArchivePage();
		?>
		<div data-is-react-component="PageArchiveAuthor" data-component-props="<?php echo esc_attr(json_encode($PageArchiveDateProps)); ?>"></div>
	<?php endif; ?>

	<!-- DEFAULT PAGE CONTENT -->
	<?php
	if (!defined('_NCMAZ_FRONTEND_VERSION')) {
		get_template_part('template-parts/archive-common');
	}
	?>
</main>

<?php
get_footer();
