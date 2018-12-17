<?php
function get_content($content, $excerpt = false)
{
    if ($excerpt) {
        if (strlen($content) > 150) {
            return substr($content, 0, 150);
        }
    }

    return $content;
}

function create_post_slug($str)
{
    return strtolower(preg_replace(
        array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
        array('', '-', ''),
        $str
    ));
}
