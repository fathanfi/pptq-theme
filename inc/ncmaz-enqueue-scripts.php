<?php
//=================================================================================
$script = 'script';
$tag = '_loader_tag';
add_filter(
    $script . $tag,
    'ncmazTheme_addModuleTypeForScripts',
    10,
    3
);

function ncmazTheme_addModuleTypeForScripts($tag, $handle, $src)
{
    $defer = array('ncmaz-locales--default');
    if (in_array($handle, $defer)) {
        return  $tag = '<script id="' . esc_attr($handle) . '" defer src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}

// 
add_filter('style_loader_tag',  'ncmaz_theme_preload_filter', 10, 2);
function ncmaz_theme_preload_filter($html, $handle)
{
    if (strcmp($handle, 'Line_Awesome') == 0) {
        $html = str_replace("rel='stylesheet'", "rel='preload' as='style' onload='this.rel=\"stylesheet\"'", $html);
    }
    return $html;
}
// =================================================================================


// ENQUEUE LOCALE TRANSLATE JS FILES - XEM XET XOA ACTION NAY TRONG NHUNG (4,5) BAN CAP NHAT TIEP
add_action('wp_enqueue_scripts', 'ncmaz_theme_locals_scripts');
function ncmaz_theme_locals_scripts()
{
    global $ncmaz_redux_demo;
    if (!defined('_NCMAZ_FRONTEND_VERSION') || empty($ncmaz_redux_demo)) {
        return false;
    }

    $dirJS = [];
    if (file_exists(get_theme_file_path('locales'))) {
        $dirJS = new DirectoryIterator(get_theme_file_path('locales'));
    }
    if (empty($dirJS)) {
        return false;
    }

    // ONLY GET DEFAULT FILE
    if (!boolval($ncmaz_redux_demo['nc-general-settings--general-switch-polylang'])) {
        wp_enqueue_script("ncmaz-locales--default", get_theme_file_uri('locales/default.js'), [], _NCMAZ_THEME_VERSION, false);
        return;
    }

    // GET ALL FILE JS LOCALS WHEN ACTIVE POLYLANG
    foreach ($dirJS as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
            $fullName = basename($file);
            $name = 'ncmaz-locales--' . substr(basename($fullName), 0, strpos(basename($fullName), '.'));
            wp_enqueue_script($name, get_theme_file_uri('locales/' . $fullName), [], _NCMAZ_THEME_VERSION, false);
        }
    }
}

// MAIN ENQUEUE SCRIPTS
function ncmaz_theme_enqueue_script()
{
    // ENQUEUE STYLE.CSS ON PARENT AND CHILD THEME
    $parent_style = 'ncmaz-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'ncmaz-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('1.0.0')
    );

    // LINE AWESOME
    wp_register_style('Line_Awesome', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css');
    wp_enqueue_style('Line_Awesome');

    // COMMENT reply
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ncmaz_theme_enqueue_script');


// FOR DEFAULT THEME (NOT ACTIVE CORE PLUGINS) ==  AFTER ACTIVE PLUGIN THEN ALL THIS _enqueue_ WILL ENQUEUE ON CORE PLUGINS
if (!defined('_NCMAZ_FRONTEND_VERSION')) {
    // ENQUEUE FOR FRONT_END
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('ncmaz-script', get_template_directory_uri() . '/assets/js/scripts.js', ['jquery'], _NCMAZ_THEME_VERSION, true);
        wp_enqueue_style('ncmaz-main-styles', get_template_directory_uri() . '/assets/css/main.css', [], _NCMAZ_THEME_VERSION, 'all');
    });

    // ENQUEUE FOR BACKEND EDITOR
    function ncmaz_theme_enqueue_admin_stylesheet($hook)
    {
        if ($hook !== 'post.php') {
            return;
        }
        wp_enqueue_style('ncmaz-editor', get_template_directory_uri() . '/assets/editor-css/index.css', [], _NCMAZ_THEME_VERSION, 'all');
        wp_enqueue_style('ncmaz-style-editor', get_template_directory_uri() . '/assets/editor-css/style-index.css', [], _NCMAZ_THEME_VERSION, 'all');
    }
    add_action('admin_enqueue_scripts', 'ncmaz_theme_enqueue_admin_stylesheet');
}
