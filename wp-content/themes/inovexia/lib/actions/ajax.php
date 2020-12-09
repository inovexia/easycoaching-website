<?php
function AJAX(){
    $posts = get_posts(array(
    	'numberposts'	=> 1,
    	'post_type'		=> 'contact_mail',
    	'meta_key'		=> 'email',
    	'meta_value'	=> $_POST['email']
    ));
    $id = empty($posts)? wp_insert_post(array('post_title'=>$_POST['name'], 'post_type'=>'contact_mail', 'post_status' => 'publish')): $posts[0]->ID;
    if($id){
        add_filter( 'wp_mail_content_type', 'set_html_content_type' );
        add_filter( 'wp_mail_charset', 'utf8' );
        $headers[] = 'From: Indiatests <noreply@indiatests.in>';
        $headers[] = 'Cc: '.$_POST['email'];
        //$headers[] = 'Bcc: 4nkit5hukla@gmail.com';
        $headers[] = 'X-Mailer: PHP/5.6.28';
        $headers[] = 'Content-Type: text/html';
        update_field('name', $_POST['name'], $id);
        update_field('email', $_POST['email'], $id);
        update_field('phone', $_POST['phone'], $id);
        update_field('subject', $_POST['subject'], $id);
        update_field('message', $_POST['message'], $id);
        if(wp_mail( 'support@indiatests.in', 'Contact Request from ' . $_POST['name'], $_POST['email'] . "<br>" .$_POST['message'], $headers)){
            $response = array('status'=>200, 'message'=> 'We recieved your Request, A mail will be sent shortly.');
            $code = 200;
        }else{
            $response = array('status'=>202, 'message'=> 'We recieved your Request, We Will Respond Soon.');
            $code = 202;
        }
        wp_send_json($response,$code);
    }
    exit;
}
add_action('wp_ajax_AJAX', 'AJAX');
add_action("wp_ajax_nopriv_AJAX", 'AJAX');