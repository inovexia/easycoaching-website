<?php
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#8250;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#8250;&nbsp;&nbsp; ";
                the_title(); 
                echo "&nbsp;&nbsp;&#8250;&nbsp;";
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#8250;&nbsp;";
        echo the_title(); 
        echo "&nbsp;&nbsp;&#8250;&nbsp;";
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#8250;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}