<?php
add_filter( 'body_class', 'add_slug_body_class' );
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    if(is_front_page()){
        if (($index = array_search('page', $classes)) !== false) {
            unset($classes[$index]);
        }
    }
    return $classes;
}