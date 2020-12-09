<?php
if (!function_exists('enqueue_assets')) {
    add_action('wp_enqueue_scripts', 'enqueue_assets');
	
    function enqueue_assets() {
		
        global $wp_widget_factory, $wp_scripts;

        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_head', 'categoryPosts\wp_head', 10);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
        wp_deregister_style('wp-block-library');
		
		/* styles */
		wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/font/fontawesome/fontawesome.min.css');
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/vendor/bootstrap.min.css');
        wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom.css');
        wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css');
        wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');			
		
		//$dynamic_css = (get_field('dynamic_css', 'option'))?get_field('dynamic_css', 'option'):'';
        //if($dynamic_css!=""){
        //    wp_add_inline_style('dynamic_custom', $dynamic_css);
        //}
		/* scripts */
        add_filter( 'wpcf7_load_js', '__return_false' ); // Disable CF7 JavaScript
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        wp_deregister_script('jquery-migrate');
        wp_deregister_script('wp-embed');
        wp_enqueue_script('jquery-core', get_template_directory_uri() . '/assets/js/vendor/jquery.min.js', array(), '1.0.0', true);
        wp_enqueue_script('bootstrap-min', get_template_directory_uri() . '/assets/js/vendor/bootstrap.bundle.min.js', array(), '1.0.0', true);
        wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true);

        if(!(is_page('contact-us-2')||is_page('lms-pricing')||is_page('contact-us'))){
            wp_deregister_style('contact-form-7');
            wp_deregister_script('contact-form-7');
            wp_deregister_script('google-recaptcha');
            wp_deregister_script('wpcf7-recaptcha');
            //async defer
            // wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit', array('jquery'), '2.0', true);
        }

       // $dynamic_js = (get_field('dynamic_js', 'option'))?get_field('dynamic_js', 'option'):"";
       // if($dynamic_js != ""){
       //     wp_add_inline_script('custom', $dynamic_js);
       // }
    }
	
    if ( ! is_admin() ){
        add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
        function add_async_attribute($tag, $handle) {
            return str_replace( ' src', ' defer src', $tag );
        }
    }
	
	add_action('wp_head', function () {
	  global $wp_scripts;

	  foreach ($wp_scripts->queue as $handle) {
		@$script = $wp_scripts->registered[$handle];

		// This script's doesn't belong in my theme; don't preload.
		if (@strpos($script->src, "/themes/inovexia/") === false) {
		  continue;
		}

		if (isset($script->extra['group']) && $script->extra['group'] === 1) {
		  $source = $script->src . ($script->ver ? "?ver={$script->ver}" : "");
		  echo "<link rel='preload' href='{$source}' as='script'/>\n";
		}
	  }
	}, 1);
}