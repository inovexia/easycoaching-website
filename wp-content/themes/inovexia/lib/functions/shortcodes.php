<?php
function array_sort($array, $on, $order = 'SORT_ASC') {
    $new_array = array();
    $sortable_array = array();
    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        switch ($order) {
            case 'SORT_ASC':
                asort($sortable_array);
            break;
            case 'SORT_DESC':
                arsort($sortable_array);
            break;
        }
        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }
    return array_values(array_filter($new_array));
}
add_shortcode('H5P_Quiz_List', 'H5P_Quiz_List_fun');
function H5P_Quiz_List_fun($att) {
    global $wpdb;
    if (is_array($att)) {
        extract($att);
    }
    $tableName = $wpdb->prefix . "h5p_contents";
    $results = $wpdb->get_results("SELECT id, title FROM $tableName");
    $Quizes = array();
    foreach ($results as $i => $quizRecord) {
        $Quizes[$i] = array('id' => $quizRecord->id, 'title' => $quizRecord->title);
    }
    $Quizes = array_sort($Quizes, 'id', 'SORT_ASC');
    $output = '<ul class="list-group">';
    foreach ($Quizes as $i => $Quiz) {
        $output.= '<li class="list-group-item">';
        $output.= '<div class="media">';
        $output.= '<div class="media-body my-auto">';
        $output.= '<a href="' . home_url('start-quiz?id=' . $Quiz['id']) . '" class="t-name">';
        $output.= $Quiz['title'];
        $output.= '</a>';
        $output.= '</div>';
        if (!isset($nobutton)) {
            $output.= '<div class="media-right">';
            $output.= '<a href="' . home_url('start-quiz?id=' . $Quiz['id']) . '" class="btn btn-primary">Start Quiz</a>';
            $output.= '</div>';
        }
        $output.= '</div>';
        $output.= '</li>';
    }
    $output.= "</ul>";
    return $output;
}
add_shortcode('H5P_Quiz_tagList', 'H5P_Quiz_tagList_fun');
function H5P_Quiz_tagList_fun($att) {
    global $wpdb;
    if (is_array($att)) {
        extract($att);
    }
    $tableContents = $wpdb->prefix . "h5p_contents";
    $tableContentsTags = $wpdb->prefix . "h5p_contents_tags";
    $tableTags = $wpdb->prefix . "h5p_tags";
    $results = $wpdb->get_results("SELECT `id`, `title` FROM `$tableContents` WHERE `id` in (
        SELECT `content_id` FROM `$tableContentsTags` WHERE `tag_id` in (
            SELECT `id` FROM `$tableTags` WHERE `name` = '$tag'
        )
    )");
    $Quizes = array();
    foreach ($results as $i => $quizRecord) {
        $Quizes[$i] = array('id' => $quizRecord->id, 'title' => $quizRecord->title);
    }
    $Quizes = array_sort($Quizes, 'id', 'SORT_ASC');
    $output = '<ul class="list-group">';
    foreach ($Quizes as $i => $Quiz) {
        $output.= '<li class="list-group-item">';
        $output.= '<div class="media">';
        $output.= '<div class="media-body my-auto">';
        $output.= '<a href="' . home_url('start-quiz?id=' . $Quiz['id']) . '" class="t-name">';
        $output.= $Quiz['title'];
        $output.= '</a>';
        $output.= '</div>';
        if (!isset($nobutton)) {
            $output.= '<div class="media-right">';
            $output.= '<a href="' . home_url('start-quiz?id=' . $Quiz['id']) . '" class="btn btn-primary">Start Quiz</a>';
            $output.= '</div>';
        }
        $output.= '</div>';
        $output.= '</li>';
    }
    $output.= "</ul>";
    return $output;
}
add_shortcode('Contact_Us_Form', 'Contact_Us_Form_fun');
function Contact_Us_Form_fun($att){
    extract(shortcode_atts(array(
        'title' => 'Get In Touch',
        'subtitle' => 'Easily add subscribe and contact forms without any server-side integration.',
        'button_label' => 'Submit',
        'button_icon' => '',
    ), $att));
    $icon = ($button_icon!='')?" <i class=\"fa $button_icon\"></i>":'';
    $output = "";
    $output .= "<div class=\"contact-us-form my-4\">";
        $output .= "<div class=\"row justify-content-center\">";
            $output .= "<div class=\"col-12\">";
                $output .= "<h2 class=\"pb-3 text-display-1\"><strong>$title</strong></h2>";
                $output .= "<h3 class=\"pb-3 h3\">$subtitle</h3>";
            $output .= "</div>";
            $output .= "<div class=\"col-12\">";
                $output .= "<form method=\"post\">";
                    $output .= "<div class=\"row\">";
                        $output .= "<div class=\"col-12 col-md-6\">";
                            $output .= "<div class=\"form-group mb-4\">";
                                $output .= "<label class=\"form-control-label\" for=\"name\">Name<span class=\"text-red-A700\">*</span></label>";
                                $output .= "<input type=\"text\" class=\"form-control rounded-0\" name=\"name\" required id=\"name\">";
                            $output .= "</div>";
                            $output .= "<div class=\"form-group mb-4\">";
                                $output .= "<label class=\"form-control-label\" for=\"email\">Email<span class=\"text-red-A700\">*</span></label>";
                                $output .= "<input type=\"email\" class=\"form-control rounded-0\" name=\"email\" required id=\"email\">";
                            $output .= "</div>";
                            $output .= "<div class=\"form-group\">";
                                $output .= "<label class=\"form-control-label\" for=\"phone\">Phone<span class=\"text-red-A700\">*</span></label>";
                                $output .= "<input type=\"tel\" class=\"form-control rounded-0\" name=\"phone\" required id=\"phone\">";
                            $output .= "</div>";
                        $output .= "</div>";
                        $output .= "<div class=\"col-12 col-md-6\">";
                            $output .= "<div class=\"form-group mb-4\">";
                                $output .= "<label class=\"form-control-label\" for=\"subject\">Subject</label>";
                                $output .= "<input type=\"text\" class=\"form-control rounded-0\" name=\"subject\" id=\"subject\">";
                            $output .= "</div>";
                            $output .= "<div class=\"form-group\">";
                                $output .= "<label class=\"form-control-label\" for=\"message\">Message</label>";
                                $output .= "<textarea type=\"text\" class=\"form-control noresize rounded-0\" name=\"message\" rows=\"5\" required id=\"message\"></textarea>";
                            $output .= "</div>";
                        $output .= "</div>";
                        $output .= "<div class=\"col-12 col-md-6\">";
                            $output .= "<div class=\"form-group mb-0\">";
                                $output .= "<div id=\"g-recaptcha\" class=\"g-recaptcha d-flex justify-content-center\"></div>";
                            $output .= "</div>";
                        $output .= "</div>";
                        $output .= "<div class=\"col-12 col-md-6\">";
                            $output .= "<div class=\"text-center h-100\">";
                                $output .= "<button type=\"submit\" class=\"btn btn-primary btn-block btn-lg h-100 rounded-0\">$button_label$icon</button>";
                            $output .= "</div>";
                        $output .= "</div>";
                    $output .= "</div>";
                $output .= "</form>";
            $output .= "</div>";
        $output .= "</div>";
    $output .= "</div>";
    return $output;
}