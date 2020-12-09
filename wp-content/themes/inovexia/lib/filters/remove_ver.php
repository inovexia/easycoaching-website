<?php
if (!function_exists('removeAssetsVersion')) {
    if (!is_admin()) {
        add_filter('script_loader_src', 'removeAssetsVersion', 15, 1);
        add_filter('style_loader_src', 'removeAssetsVersion', 15, 1);
    }
    function removeAssetsVersion($src) {
        return remove_query_arg('ver', $src);
    }
}
