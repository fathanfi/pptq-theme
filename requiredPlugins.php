<?php
require_once get_template_directory()  . '/class-tgm-plugin-activation.php';


if (!function_exists('ncmaz_theme_register_required_plugins')) :
	function ncmaz_theme_register_required_plugins()
	{
		// 
		$NcmazCoreVersion = '4.1.0';
		$NcmazFrontendVersion = '4.1.3';
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

			// WPGraphQL Extensions
			[
				'name'     	=> 'Total Counts for WPGraphQL',
				'slug'     	=> 'total-counts-for-wp-graphql',
				'source'   	=> 'https://github.com/builtbycactus/total-counts-for-wp-graphql/archive/refs/heads/master.zip',
				'required' 	=> true,
			],
			[
				'name'     	=> 'WPGraphQL for Advanced Custom Fields',
				'slug'     	=> 'wp-graphql-acf',
				'source'   	=> 'https://github.com/wp-graphql/wp-graphql-acf/archive/refs/heads/develop.zip',
				'required' 	=> true,
			],
		];

		/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
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


// DE-ACTIVE ncmaz-demo-importer PLUGIN FOR OLD CLIENTS
// WILL REMOVE ON NEXT UPDATE
if (is_admin()) {
	add_action('init',  function () {
		if (is_plugin_active('ncmaz-demo-importer/ncmaz-demo-importer.php')) {
			deactivate_plugins('ncmaz-demo-importer/ncmaz-demo-importer.php');
		}
	});
}
