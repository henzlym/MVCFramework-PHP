<?php
class Posts extends Controller
{
    public $data;
    public $posts_model;
    public $url;
    public $db;

    function __construct($data = null, $post = null)
    {
        $this->data = $data;
        $this->posts_model = $this->model('Post');
        $this->db = new Database;
        $this->url = get_url();
    }

    public function index()
    {
        if (isset($this->url[1])) {
            $post = $this->posts_model->get_post('post_slug', $this->url[1]);
            $this->data = [
                'posts' => $post
            ];

            $this->view('posts/single', $this->data);

        } else {
            $posts = $this->posts_model->get_posts();
            $this->data = [
                'posts' => $posts
            ];

            $this->view('posts/index', $this->data);
        }


    }

    public function add()
    {
        if (!is_logged_in()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $this->data = [
                'post_title' => trim($_POST['post_title']),
                'post_content' => trim($_POST['post_content']),
                'post_content_error' => '',
                'post_title_error' => '',
            ];

            if (empty($this->data['post_title'])) {
                $this->data['post_title_error'] = 'Please enter post title';
            }

            if (empty($this->data['post_content'])) {
                $this->data['post_content_error'] = 'Please enter content for posts';
            }

            $post_found = $this->posts_model->get_post('post_title', $this->data['post_title']);
            if ($post_found) {
                $this->data['post_title_error'] = 'Post already exists, select another title.';
            }
            //Make sure errors are not empty
            if (empty($this->data['post_title_error']) && empty($this->data['post_content_error'])) {

                $added_posts = $this->posts_model->add_post($this->data);

                if ($added_posts) {

                    set_alert_message('post_message', 'Post was successfully added', 'alert-success');
                    redirect('posts');

                }


            }

        } else {

            $this->data = [
                'post_title' => '',
                'post_content' => '',
                'post_title_error' => '',
                'post_content_error' => '',
            ];
        }

        $this->view('posts/add', $this->data);
    }

    public function edit($id = null)
    {

        if (!is_logged_in()) {
            redirect('users/login');
        }

        if ($id == null) {
            redirect('posts');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $this->data = [
                'ID' => $id,
                'post_title' => trim($_POST['post_title']),
                'post_content' => trim($_POST['post_content']),
                'post_content_error' => '',
                'post_title_error' => '',
            ];

            if (empty($this->data['post_title'])) {
                $this->data['post_title_error'] = 'Please enter post title';
            }

            if (empty($this->data['post_content'])) {
                $this->data['post_content_error'] = 'Please enter content for posts';
            }

            //Make sure errors are not empty
            if (empty($this->data['post_title_error']) && empty($this->data['post_content_error'])) {

                $added_posts = $this->posts_model->update_post($this->data);

                if ($added_posts) {

                    set_alert_message('post_message', 'Post was successfully updated', 'alert-success');
                    redirect('posts');

                }


            }

        } else {

            $post = $this->posts_model->get_post('ID', $id);
            if ($post[0]->post_author != get_user_id()) {
                redirect('posts');
            }

            $this->data = [
                'ID' => $id,
                'post_title' => $post[0]->post_title,
                'post_content' => $post[0]->post_content,
                'post_title_error' => '',
                'post_content_error' => '',
            ];
        }

        $this->view('posts/edit', $this->data);

    }

    public function delete($id = null)
    {
        if ($id == null) {
            redirect('posts');
        }

        $post = $this->posts_model->get_post('ID', $id);

        if ($post[0]->post_author != get_user_id()) {
            redirect('posts');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleted = $this->posts_model->delete_post($id);

            if ($deleted) {
                set_alert_message('post_message', 'Post was successfully deleted', 'alert-success');
            } else {
                set_alert_message('post_message', 'Post was not deleted', 'alert-danger');
            }
        }

        redirect('posts');

    }
}
