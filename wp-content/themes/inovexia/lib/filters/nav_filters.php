<?php
add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);
function add_classes_on_li($classes, $item, $args){
    $classes[] = 'nav-item';
    return $classes;
}
add_filter('wp_nav_menu', 'add_classes_on_a');
function add_classes_on_a($ulclass){
    return preg_replace('/<a /', '<a class="nav-link" ', $ulclass);
}
function add_menu_link_class($atts, $item, $args) {
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );