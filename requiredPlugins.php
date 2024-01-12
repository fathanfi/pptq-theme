<?php
require_once get_template_directory()  . '/class-tgm-plugin-activation.php';


if (!function_exists('ncmaz_theme_register_required_plugins')) :
	function ncmaz_theme_register_required_plugins()
	{
		// 
		$NcmazCoreVersion = _NCMAZ_CORE_VERSION_REQUIRE;
		$NcmazFrontendVersion = _NCMAZ_FRONTEND_VERSION_REQUIRE;
		// 

		$plugins = [
			// A WordPress.org plugin repository example.
			[
				'name'     	=> 'WooCommerce',
				'slug'     	=> 'woocommerce',
				'required' 	=> false,
			],
			[
				'name'     	=> 'Advanced Custom Fields',
				'slug'     	=> 'advanced-custom-fields',
				'required' 	=> true,
			],
			[
				'name'     	=> 'Favorites',
				'slug'     	=> 'favorites',
				'required' 	=> true,
			],
			[
				'name'     	=> 'Email Subscribers & Newsletters',
				'slug'     	=> 'email-subscribers',
				'required' 	=> false,
			],
			[
				'name'     	=> 'Nextend Social Login',
				'slug'     	=> 'nextend-facebook-connect',
				'required' 	=> false,
			],
			[
				'name'     	=> 'Reading Time Wp',
				'slug'     	=> 'reading-time-wp',
				'required' 	=> true,
			],
			[
				'name'     	=> 'Template Library and Redux Framework',
				'slug'     	=> 'redux-framework',
				'required' 	=> true,
			],
			[
				'name'     	=> 'WP GraphQL',
				'slug'     	=> 'wp-graphql',
				'required' 	=> true,
			],
			[
				'name'     	=> 'One click demo import',
				'slug'     	=> 'one-click-demo-import',
				'required' 	=> false,
			],

			// A locally theme bundled plugin example.
			[
				'name'     	=> 'PPTQ Core',
				'slug'     	=> 'pptq-core',
				'source'   	=> get_template_directory() . '/bundled-plugins/ncmaz-core.zip',
				'required' 	=> true,
				'version'	=> $NcmazCoreVersion
			],
			[
				'name'     	=> 'PPTQ Frontend',
				'slug'     	=> 'pptq-frontend',
				'source'   	=> get_template_directory() . '/bundled-plugins/ncmaz-frontend.zip',
				'required' 	=> true,
				'version'	=> $NcmazFrontendVersion
			],
			[
				'name'     	=> 'WPGraphQL for Advanced Custom Fields',
				'slug'     	=> 'wp-graphql-acf',
				'source'   	=> 'https://github.com/wp-graphql/wp-graphql-acf/archive/master.zip',
				'required' 	=> true,
				'version'	=> '0.6.1'
			],
		];


		$config = [
			'id'           => 'ncmaztgmpa',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '<div style="background:#fff;  padding: 24px; border: 2px solid #7c3aed; border-radius: 10px;" ><h3>🆘⛔⛔⛔🆘 <strong style="color: red;">HEY!</strong>:  Sorry! Please 10 seconds for this importance message before update plugins:</h3>
				<p style="font-size: 16px">In the <strong>Ncmaz-core v3.0</strong> plugin update there have been significant changes to make the ncmaz theme better performance and experience. <br /> Including the reconstruction of the Ncmaz Gutenberg blocks, this results in displaying errors in Gutenberg blocks when you edit home page.  <br />  Please don\'t worry, follow this guide - <a href="https://nghiaxchis.gitbook.io/ncmaz-wordpress/theme-installation/error-after-update-theme" target="_blank" rel="noopener noreferrer">Handling after plugin update.</a> </p>
					<p style="font-size: 16px">Thanks for reading! </p>
			</div>',
		];
		tgmpa($plugins, $config);
	}
	add_action('tgmpa_register', 'ncmaz_theme_register_required_plugins');
endif;


// 
// NOTICES CHECK PLUGIN UPDATED NOT OK
if (!function_exists('ncmazTheme_admin_notice_ncmaz_plugins_not_updated')) :
	add_action('admin_notices', 'ncmazTheme_admin_notice_ncmaz_plugins_not_updated');
	function ncmazTheme_admin_notice_ncmaz_plugins_not_updated()
	{
		if (!defined('_NCMAZ_CORE_VERSION') || !defined('_NCMAZ_CORE_VERSION_REQUIRE') || !defined('_NCMAZ_FRONTEND_VERSION_REQUIRE') || !defined('_NCMAZ_FRONTEND_VERSION')) {
			return;
		}
		if (!function_exists('ncmazTheme_string_version_toInt')) {
			return;
		}

		$ncmaz_frontend_version_int = ncmazTheme_string_version_toInt(_NCMAZ_FRONTEND_VERSION);
		$ncmaz_frontend_require_version_int = ncmazTheme_string_version_toInt(_NCMAZ_FRONTEND_VERSION_REQUIRE);
		$ncmaz_core_version_int = ncmazTheme_string_version_toInt(_NCMAZ_CORE_VERSION);
		$ncmaz_core_require_version_int = ncmazTheme_string_version_toInt(_NCMAZ_CORE_VERSION_REQUIRE);

		//  FOR SOME ORTHER
		$ncmaz_other_version_init = !empty(WPGRAPHQL_VERSION) ? ncmazTheme_string_version_toInt(WPGRAPHQL_VERSION) : 0;
		$ncmaz_other_require_version_int = ncmazTheme_string_version_toInt('1.13.5');
		// 

		$isNcmazFrontendOk = $ncmaz_frontend_version_int >= $ncmaz_frontend_require_version_int;
		$isNcmazCoreOk =  $ncmaz_core_version_int >= $ncmaz_core_require_version_int;
		$isNcmazOrtherOk = $ncmaz_other_version_init >= $ncmaz_other_require_version_int;

		if ($isNcmazFrontendOk && $isNcmazCoreOk && $isNcmazOrtherOk) {
			return;
		}

?>
		<div class="notice notice-error is-dismissible">
			<?php if (!$isNcmazFrontendOk || !$isNcmazCoreOk) : ?>
				<p style="color: chocolate;">
					<strong style="text-decoration: underline;">*Importance:</strong> You need to update <strong>ncmaz-core plugin</strong> & <strong>ncmaz-frontend plugin</strong> to work properly with this theme version. Otherwise, an unexpected error may occur.
				</p>
			<?php endif; ?>

			<?php if (!$isNcmazOrtherOk) : ?>
				<p style="color: chocolate;">
					<strong style="text-decoration: underline;">*Importance:</strong> You need to update <strong style="text-decoration: underline ;">WP-graphql </strong> plugin to work properly with this theme version. Otherwise, an unexpected error may occur.
				</p>
			<?php endif; ?>


			<p>
				Navigate to <strong>Appearance -> Install Plugin -> Active/Update</strong> the <strong>required</strong> plugins.
			</p>
		</div>
<?php
	}
endif;



// DE-ACTIVE ncmaz-demo-importer PLUGIN FOR OLD CLIENTS
// WILL REMOVE ON NEXT UPDATE
if (is_admin()) {
	add_action('init',  function () {
		if (is_plugin_active('ncmaz-demo-importer/ncmaz-demo-importer.php')) {
			deactivate_plugins('ncmaz-demo-importer/ncmaz-demo-importer.php');
		}
	});
}
