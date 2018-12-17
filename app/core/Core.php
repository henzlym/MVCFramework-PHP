<?php

/**
 * App Core Class
 * Creates Url and Loads core controller
 * Creates Pretty urls /page/category/id
 */
class Core
{
    protected $current_contoller = 'Page';
    protected $current_method = 'index';
    protected $params = array();


    function __construct()
    {
        $url = get_url();
        $data = null;
        $db = new Database;
        $sql = "SELECT post_type FROM posts WHERE post_slug = :slug";
        $values = array(':slug' => $url[0]);
        $page = $db->query($sql, 'fetch', $values);

        if ($page) {
            $controller = ucwords($page->post_type);
        } else {
            $controller = ucwords($url[0]);
        }
        //Look in controllers for first value
        if (file_exists('./app/controllers/' . $controller . '.php')) {
            $this->current_contoller = $controller;
            $sql = "SELECT * FROM posts WHERE post_slug = :slug";
            $values = array(':slug' => $url[0]);
            $data = $db->query($sql, 'fetch', $values);
            unset($url[0]);
        }

        // Require the controller
        require_once './app/controllers/' . $this->current_contoller . '.php';

        //Instantiate controller class
        $this->current_contoller = new $this->current_contoller($data);

        //Check if second param exists in controller
        if (isset($url[1])) {
            if (method_exists($this->current_contoller, $url[1])) {
                $this->current_method = $url[1];
                unset($url[1]);
            }
        }

        //echo $this->current_method;
        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->current_contoller, $this->current_method], $this->params);
    }


}
