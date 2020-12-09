<?php
function register_menu() {
    register_nav_menus(array('Main Menu' => __('main menu'), 'Footer Menu' => __('footer menu')));
}
add_action( 'init', 'register_menu' );