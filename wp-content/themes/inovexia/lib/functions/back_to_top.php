<?php
//add_action('upper_footer', 'back_to_top_button');
function back_to_top_button(){
    echo '<div id="back2top" class="d-none absolute right bottom overflow-hidden">
        <a class="btn border-0 rounded-0 bg-transparent width-40 height-40 position-relative" title="Back to Top" href="javascript:void(0);">
            <span class="right"></span>
            <span class="up"></span>
        </a>
    </div>';
}