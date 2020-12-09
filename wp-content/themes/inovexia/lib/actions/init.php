<?php
add_action( 'get_header', 'learningapp_init' );
function learningapp_init() {
    if(isset($_GET['hide_admin_bar'])){
        update_option('show_admin_bar', false);
        if ( wp_redirect( get_permalink() ) ) {
            exit;
        }
    }
    if(isset($_GET['show_admin_bar'])){
        update_option('show_admin_bar', true);
        if ( wp_redirect( get_permalink() ) ) {
            exit;
        }
    }
    if(is_singular('resource')){
        session_start();
        if(isset($_GET['tab'])){
            $_SESSION['tab'] = $_GET['tab'];
            if ( wp_redirect( get_permalink() ) ) {
                exit;
            }
        }
    }
}