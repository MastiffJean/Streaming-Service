<?php

class Admin_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // #############################################################################

    // **
    // NEWS
    // **

    public function add_news($title, $description, $content, $image, $publish, $status) {

        $check = $this->checkNews($title);

        if($check == TRUE) {
            
            $data = [
                'title' => $title,
                'description' => $description,
                'content' => $content,
                'image' => $image,
                'publish' => $publish,
                'status' => $status
            ];
            $this->db->insert('news', $data);

            return TRUE;
        } else {
            return FALSE;
        }
        
    }

    public function checkNews($title) {
        $query = $this->db->get_where('news', array('title' => $title));
        $check = $query->result_array();
        if(count($check) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_news($news_id, $title, $description, $content) {

        $data = array(
            'title' => $title,
            'description' => $description,
            'content' => $content
        );

        $this->db->where('id', $news_id);
        $this->db->update('news', $data);

    }

    public function delete_news($news_id) {

        $news = $this->news->get_news_by_id($news_id);
        $dir_path = 'assets/news_img/';
        $file_path = $dir_path.$news[0]['image'];
        unlink($file_path);

        $this->db->where('news.id', $news_id);
        $this->db->delete('news');
    }

    // **
    // END NEWS
    // **

    // #############################################################################

    // **
    // CATEGORIES
    // **

    public function add_category($name, $image) {

        $check = $this->checkCategory($name);

        if($check == TRUE) {
            
            $data = [
                'name' => $name,
                'image' => $image
            ];
            $this->db->insert('categories', $data);

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkCategory($name) {
        $query = $this->db->get_where('categories', array('name' => $name));
        $check = $query->result_array();
        if(count($check) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_category($category_id, $name) {

        $data = array(
            'name' => $name
        );

        $this->db->where('id', $category_id);
        $this->db->update('categories', $data);
    }

    public function delete_category($category_id) {

        $this->db->where('categories.id', $category_id);
        $this->db->delete('categories');
    }

    // **
    // END CATEGORIES
    // **

    // #############################################################################

}