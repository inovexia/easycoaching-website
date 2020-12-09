<?php
if (!function_exists('themeSetup')) {
    add_action('after_setup_theme', 'themeSetup');
    function themeSetup() {
        $defaults = array('flex-height' => true, 'flex-width' => true, 'header-text' => array('site-title', 'site-description'),);
        add_theme_support('custom-logo', $defaults);
        add_theme_support('title-tag');
        add_theme_support( 'post-thumbnails' );
    }
}