<?php

/**
 * User class
 */
class Users extends Controller
{
    public function __construct()
    {
        $this->user_model = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'user_name' => trim($_POST['user_name']),
                'user_email' => trim($_POST['user_email']),
                'user_password' => trim($_POST['user_password']),
                'confrim_password' => trim($_POST['confrim_password']),
                'user_email_error' => '',
                'user_password_error' => '',
                'confrim_password_error' => ''
            ];

            if (empty($data['user_email'])) {
                $data['user_email_error'] = 'Please enter email';
            } else {
                $user_found = $this->user_model->get_user('user_email', $data['user_email']);

                if ($user_found) {
                    $data['user_email_error'] = 'Email is already taken';
                }
            }

            if (empty($data['user_name'])) {
                $data['user_name_error'] = 'Please enter username';
            }

            if (empty($data['user_password'])) {
                $data['user_password_error'] = 'Please enter password';
            } elseif (strlen($data['user_password']) < 6) {
                $data['user_password_error'] = 'Password must be at least 6 characters';
            }

            if (empty($data['confrim_password'])) {
                $data['confrim_password_error'] = 'Please confirm password';
            } else {
                if ($data['user_password'] !== $data['confrim_password']) {
                    $data['confrim_password_error'] = 'Passwords do not match';
                }
            }

            //Make sure errors are not empty
            if (empty($data['user_email_error']) && empty($data['user_name_error']) && empty($data['user_password_error']) && empty($data['confrim_password_error'])) {

                $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);

                $result = $this->user_model->register($data);

                if ($result) {
                    set_alert_message('register_success', 'User was successfully registered', 'alert-success');
                    redirect('users/login');
                }
                die('Something went wrong');
            }

        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'user_name' => '',
                'user_email' => '',
                'user_password' => '',
                'confrim_password' => '',
                'first_name_error' => '',
                'last_name_error' => '',
                'user_email_error' => '',
                'user_password_error' => '',
                'confirm_password_error' => ''
            ];
        }



        $this->view('users/register', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'user_email' => trim($_POST['user_email']),
                'user_password' => trim($_POST['user_password']),
                'user_password_error' => '',
                'user_email_error' => '',
            ];

            if (empty($data['user_email'])) {
                $data['user_email_error'] = 'Please enter email';
            }

            if (empty($data['user_password'])) {
                $data['user_password_error'] = 'Please enter password';
            } elseif (strlen($data['user_password']) < 6) {
                $data['user_password_error'] = 'Password must be at least 6 characters';
            }
            $user_found = $this->user_model->get_user('user_email', $data['user_email']);
            if (!$user_found) {
                $data['user_email_error'] = 'No user was found, try again.';
            }
            //Make sure errors are not empty
            if (empty($data['user_email_error']) && empty($data['user_password_error'])) {

                $user_logged_in = $this->user_model->login($data['user_email'], $data['user_password']);

                if ($user_logged_in) {
                    $_SESSION['user_id'] = $user_logged_in->ID;
                    $_SESSION['user_email'] = $user_logged_in->user_email;
                    set_alert_message('register_success', 'User was successfully registered', 'alert-success');
                    redirect('posts/add');

                } else {
                    $data['user_password_error'] = 'Incorrect password.';
                }


            }

        } else {

            $data = [
                'user_email' => '',
                'user_password' => '',
                'user_email_error' => '',
                'user_password_error' => '',
            ];
        }



        $this->view('users/login', $data);
    }

    public function logout()
    {
        session_destroy();
        redirect('users/login');
    }


}
