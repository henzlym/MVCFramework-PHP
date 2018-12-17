<?php

/**
 * undocumented class
 */
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_posts($value = 'post')
    {
        $sql = "SELECT * FROM posts INNER JOIN users on posts.post_author = users.ID WHERE posts.post_type = :val ORDER BY posts.post_date DESC";
        $execute = array(':val' => $value);
        $result = $this->db->query($sql, 'fetchAll', $execute);

        return $result;
    }
    public function get_post_author($value = '0')
    {
        $sql = "SELECT * FROM posts INNER JOIN users on posts.post_author = users.ID ORDER BY posts.post_date DESC";
        $execute = array(':val' => $value);
        $result = $this->db->query($sql, 'fetchAll', $execute);

        return $result;
    }

    public function get_post($column, $value)
    {

        $sql = "SELECT *, posts.ID as postID FROM posts INNER JOIN users on posts.post_author = users.ID WHERE posts.{$column} = :val";
        $execute = array(':val' => $value);

        $result = $this->db->query($sql, 'fetchAll', $execute);

        if (!empty($result)) {
            return $result;
        }

        return false;
    }

    public function add_post($data)
    {
        $post_author = get_user_id();
        $post_slug = create_post_slug($data['post_title']);

        $sql = "INSERT INTO posts (post_title,post_content,post_author,post_slug) VALUES (:post_title,:post_content,:post_author,:post_slug)";
        $execute = array(
            ':post_title' => $data['post_title'],
            ':post_content' => $data['post_content'],
            ':post_author' => $post_author,
            ':post_slug' => $post_slug
        );

        $result = $this->db->query($sql, 'execute', $execute);

        if ($result) {
            return true;
        }
        return false;
    }

    public function update_post($data)
    {
        $post_author = get_user_id();
        $post_slug = create_post_slug($data['post_title']);

        $sql = "UPDATE posts SET post_title = :post_title, post_content = :post_content WHERE ID = :ID";
        $execute = array(
            ':ID' => $data['ID'],
            ':post_title' => $data['post_title'],
            ':post_content' => $data['post_content'],
        );

        $result = $this->db->query($sql, 'execute', $execute);

        if ($result) {
            return true;
        }
        return false;
    }

    public function delete_post($id)
    {
        $sql = "DELETE FROM posts WHERE ID = :ID";
        $execute = array(
            ':ID' => $id,
        );

        $result = $this->db->query($sql, 'execute', $execute);

        if ($result) {
            return true;
        }
        return false;
    }
}
