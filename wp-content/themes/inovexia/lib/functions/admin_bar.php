<?php
add_action('before_footer', 'admin_bar_toggle_button');
function admin_bar_toggle_button(){
    if(is_user_logged_in()){
        if(get_option('show_admin_bar')){
            echo '<div class="d-inline-block position-fixed" style="bottom: 0;left: 0;">
                <a class="btn rounded-0 btn-light p-2 d-flex align-items-center" title="Disable Admin Bar" href="?hide_admin_bar">
                    <i class="fa fa-toggle-off text-danger" aria-hidden="true"></i>
                </a>
            </div>';
        }else{
            echo '<div class="d-inline-block position-fixed" style="bottom: 0;left: 0;">
                <a class="btn rounded-0 btn-dark p-2 d-flex align-items-center" title="Enable Admin Bar" href="?show_admin_bar">
                    <i class="fa fa-toggle-on text-success" aria-hidden="true"></i>
                </a>
            </div>';
        }
    }
}