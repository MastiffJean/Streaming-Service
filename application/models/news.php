<?php

class News extends CI_Model
{

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // #############################################################################

    // **
    // NEWS
    // **

    public function record_news_count() {
        return $this->db->count_all("news");
    }

    public function fetch_news($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->from('news');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_news() {

        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->from('news');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_last_news() {
        
        $this->db->limit(4);
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->from('news');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_rand_news($news_id) {
        
        $this->db->limit(5);
        $this->db->select('*');
        $this->db->order_by('RAND()');
        $this->db->where('id !=', $news_id);
        $this->db->from('news');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_news_by_id($news_id) {
        $query = $this->db->get_where('news', array('id' => $news_id));
        return $query->result_array();
    }

    // **
    // END NEWS
    // **

}