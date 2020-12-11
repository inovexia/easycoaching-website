<?php
show_admin_bar(get_option('show_admin_bar'));
// add_filter('show_admin_bar', '__return_false');
//add_action('wp', function(){ echo '<pre>';print_r($GLOBALS['wp_filter']); echo '</pre>';exit; } );
$include_files = array(
    'init' => get_template_directory(). '/lib/actions/init.php',
    'setup' => get_template_directory(). '/lib/actions/setup.php',
    'create_posttype' => get_template_directory(). '/lib/actions/create_posttype.php',
    'register_menu' => get_template_directory(). '/lib/actions/register_menu.php',
    'enqueue_assets' => get_template_directory(). '/lib/actions/enqueue_assets.php',
    'ajax' => get_template_directory(). '/lib/actions/ajax.php',
    'remove_ver' => get_template_directory(). '/lib/filters/remove_ver.php',
    'nav_filters' => get_template_directory(). '/lib/filters/nav_filters.php',
    'php_execute' => get_template_directory(). '/lib/filters/php_execute.php',
    'add_slug_body_class' => get_template_directory(). '/lib/filters/add_slug_body_class.php',
    'widgets' => get_template_directory(). '/lib/widget/widgets.php',
    'shortcodes' => get_template_directory(). '/lib/functions/shortcodes.php',
    'get_breadcrumb' => get_template_directory(). '/lib/functions/get_breadcrumb.php',
    'admin_bar' => get_template_directory(). '/lib/functions/admin_bar.php',
    'back_to_top' => get_template_directory(). '/lib/functions/back_to_top.php',
    'classes' => get_template_directory() . '/lib/classes/learningAppWalker.php',
    'html-minify' => get_template_directory() . '/lib/classes/html-minify.php'
);
foreach ($include_files as $handler => $file) {
    if (file_exists($file)) {
        include $file;
    }
}
function convertYoutube($string) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"https://www.youtube.com/embed/$2",
		$string
	);
}


if( function_exists('acf_add_options_page') ) { 
    acf_add_options_page(array(
      'page_title'  => 'Theme Settings',
      'menu_title'  => 'Theme Settings',
      'menu_slug'   => 'theme-settings',
      'capability'  => 'edit_posts',
      'redirect'    => false
    ));
    acf_add_options_sub_page(array(
      'page_title'  => 'Social Links',
      'menu_title'  => 'Social Links',
      'parent_slug' => 'theme-settings',
    )); 
  }

