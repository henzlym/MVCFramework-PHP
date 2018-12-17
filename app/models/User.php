<?php

/**
 * undocumented class
 */
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Find user by email

    public function get_user($column, $value)
    {
        $sql = "SELECT * FROM users WHERE {$column} = :val";
        $execute = array(':val' => $value);
        $result = $this->db->query($sql, 'fetch', $execute);

        if (!empty($result)) {
            return $result;
        }

        return false;
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE user_email = :user_email ";
        $execute = array(
            ':user_email' => $email,
        );

        $result = $this->db->query($sql, 'fetch', $execute);

        if ($result) {

            $hashed_password = $result->user_password;

            if (password_verify($password, $hashed_password)) {
                return $result;
            }

            return false;

        }
    }

    public function register($data)
    {
        $sql = "INSERT INTO users (username,user_email,user_password) VALUES (:username,:user_email,:user_password)";
        $execute = array(
            ':username' => $data['user_name'],
            ':user_email' => $data['user_email'],
            ':user_password' => $data['user_password']
        );
        $result = $this->db->query($sql, 'execute', $execute);
        if ($result) {
            return true;
        }
        return false;
    }

}
