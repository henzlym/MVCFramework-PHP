<?php
function redirect($page)
{
    header('Location: ' . BASE_URL . '/' . $page);
    die();
}

function get_url()
{
    if (isset($_GET['url'])) {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        return $url;
    }

}
