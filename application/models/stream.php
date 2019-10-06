<?php

class Stream extends CI_Model
{

	public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('user');

    }

    public function get_streams() {

        $query = $this->db->get_where('streams', array('status_id' => 2));
        return $query->result_array();
    }

    public function get_streams_main() {

        $this->db->limit(8);
        $query = $this->db->get_where('streams', array('status_id' => 2));
        return $query->result_array();
    }

    public function get_streams_by_category($category_id) {

        $query = $this->db->get_where('streams', array('status_id' => 2, 'category_id' => $category_id));
        return $query->result_array();
    }

    public function get_stream($stream_id) {
        $query = $this->db->get_where('streams', array('id' => $stream_id));
        $res = $query->result_array();
        return $res[0];
    }

    public function get_streams_all() {
        $query = $this->db->get('streams');
        return $query->result_array();
    }

    public function edit_stream($stream_id, $name, $description, $category_id) {

        $data = array(
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id
        );

        $this->db->where('id', $stream_id);
        $this->db->update('streams', $data);

    }

    public function add_stream($user_name) {

        $query = $this->db->get_where('users', array('login' => $user_name));
        $user = $query->result_array();

        $data = [
            'name' => '',
            'user_id' => $user[0]['id'],
            'src' => '',
            'description' => '',
            'status_id' => 1,
            'access_id' => 1,
            'category_id' => 1
        ];

        $this->db->insert('streams', $data);
    }

    public function search_streams($keyword) {

        $this->db->like('login',$keyword);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function sub_count($stream_id) {

        $this->db->from('subscribes');
        $this->db->where('stream_id', $stream_id);
        return $this->db->count_all_results();
    }

    public function get_streams_count_main() {
        $streams = $this->stream->get_streams_main();

        foreach ($streams as $row) {
            $row['count'] = $this->stream->sub_count($row['id']);
            $data[] = $row;
        }

        $countarr = array();
        foreach ($data as $key => $row)
        {
            $countarr[$key] = $row['count'];
        }
        array_multisort($countarr, SORT_DESC, $data);

        return $data;
    }

    public function get_streams_count() {
        $streams = $this->stream->get_streams();

        foreach ($streams as $row) {
            $row['count'] = $this->stream->sub_count($row['id']);
            $data[] = $row;
        }

        $countarr = array();
        foreach ($data as $key => $row)
        {
            $countarr[$key] = $row['count'];
        }
        array_multisort($countarr, SORT_DESC, $data);

        return $data;
    }

    public function record_streams_count() {

        $this->db->from('streams');
        $this->db->where('status_id', 2);
        return $this->db->count_all_results();
    }

    public function fetch_streams($limit, $start) {

        $streams = $this->stream->get_streams_count();
        $count = 0;
        $element = $start;

        while($count < $limit && $element != count($streams))
        {
            $data[] = $streams[$element];
            $element++;
            $count++;
        }
        return $data;
    }

    public function get_streams_count_by_category($category_id) {
        // $streams = array();
        $streams = $this->stream->get_streams_by_category($category_id);
        $data = array();
        if (count($streams) != null) {
            foreach ($streams as $row) {
                $row['count'] = $this->stream->sub_count($row['id']);
                $data[] = $row;
            }

            $countarr = array();
            foreach ($data as $key => $row)
            {
                $countarr[$key] = $row['count'];
            }
            array_multisort($countarr, SORT_DESC, $data);

            return $data;
        }

        return null;
        
    }

    public function record_streams_count_by_category($category_id) {

        $this->db->from('streams');
        $this->db->where('status_id', 2);
        $this->db->where('category_id', $category_id);
        return $this->db->count_all_results();
    }

    public function fetch_streams_by_category($limit, $start, $category_id) {

        $streams = $this->stream->get_streams_count_by_category($category_id);
        $count = 0;
        $element = $start;

        $data = array();
        while($count < $limit && $element != count($streams))
        {
            $data[] = $streams[$element];
            $element++;
            $count++;
        }
        return $data;
    }

    // #############################################################################

    // **
    // CATEGORIES
    // **

    public function get_categories() {

        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_category_info($category_id) {

        $query = $this->db->get_where('categories', array('id' => $category_id));
        $res = $query->result_array();
        return $res[0];
    }

    public function get_categories_6() {

        $this->db->limit(6);
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_category_by_id($category_id) {

        // $this->db->limit(1);
        $query = $this->db->get_where('categories', array('id' => $category_id));
        return $query->result_array();
    }

    public function record_category_count() {
        return $this->db->count_all("categories");
    }

    public function fetch_category($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('categories');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // **
    // END CATEGORIES
    // **

    // #############################################################################

    // **
    // STREAM STATUS
    // **

    public function get_statuses() {

        $query = $this->db->get('stream_status');
        return $query->result_array();
    }

    public function edit_status($stream_id, $status_id) {

        $data = array(
            'status_id' => $status_id
        );

        $this->db->where('id', $stream_id);
        $this->db->update('streams', $data);
    }

    // **
    // END STREAM STATUS
    // **

    // #############################################################################

    // **
    // CHAT
    // **

    public function sendMessage($stream_id, $text) {

        $user_id = $this->user->getUserId();

        $data = [
            'stream_id' => $stream_id,
            'user_id' => $user_id,
            'text' => $text
        ];
        
        $this->db->insert('stream_chat', $data);
    }

    public function getMessage($stream_id, $date) {

        $this->db->select('*');
        $this->db->order_by('id');
        $this->db->from('stream_chat');
        $this->db->where('stream_id', $stream_id);
        $this->db->where('date >', $date);
        $query = $this->db->get();

        return $query->result_array();
    }



    // **
    // END CHAT
    // **

}