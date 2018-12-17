<?php

/**
 * undocumented class
 */
class Page extends Controller
{
    function __construct($data = null)
    {
        $this->data = $data;
    }

    public function index()
    {
        if (!$this->data) {
            $this->data = (object)array(
                'post_title' => 'MVC Framework',
                'post_content' => 'This is a MVC Framework build using PHP.'
            );
        }
        $this->view('index', $this->data);
    }

    public function about()
    {
        $data = array(
            'title' => 'About',
            'description' => 'This is the about page'
        );

        $this->view('about', $data);
    }
}
