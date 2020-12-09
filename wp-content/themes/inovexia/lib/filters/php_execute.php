<?php
function php_execute($html) {
    if (strpos($html, "<" . "?php") !== false) {
        ob_start();
        eval("?" . ">" . $html);
        $html = ob_get_contents();
        ob_end_clean();
    }
    return $html;
}
add_filter('widget_text','php_execute',100);