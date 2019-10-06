<?php

class User extends CI_Model
{
    public function __construct() {

        parent::__construct();
        $this->load->database();
    }
    
    public function addUser($login, $password, $email, $regdate, $image) {

        $stream_key = $this->user->generateRandomKey();

        $data = [
            'login' => $login,
            'password' => $password,
            'email' => $email,
            'regdate' => $regdate,
            'image' => $image,
            'stream_key' => $stream_key,
            'status_id' => 1
        ];
        $this->db->insert('users', $data);
    }
    
    public function checkUser($login, $password) {

        $this->db->select('login','password');
        $conditions = [
            'login' => $login,
            'password' => $password
        ];
        $res = $this->db->get_where('users', $conditions);
        $arr = $res->result_array();
        
        if(count($arr) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkLoginIsFree($login) {

        $this->db->select('login');
        $conditions = [
            'login' => $login
        ];
        $res = $this->db->get_where('users', $conditions);
        $arr = $res->result_array();
        
        if(count($arr) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_email($user_id, $email) {
        $data = array(
            'email' => $email
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    public function edit_image($user_id, $image) {
        $data = array(
            'image' => $image
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    public function getUsers() {

        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function getUserInfo() {

        if($this->session->has_userdata('user')) {
            $login = $this->session->userdata('user');
            $query = $this->db->get_where('users', array('login' => $login));
            $res = $query->result_array();
            return $res[0];
        }
        return null;
    }

    public function getUserInfoById($user_id) {

        $query = $this->db->get_where('users', array('id' => $user_id));
        $res = $query->result_array();
        return $res[0];
    }

    public function getUserId() {
        
        $login = $this->session->userdata('user');
        $query = $this->db->get_where('users', array('login' => $login));
        $temp = $query->result_array();
        $user_id = $temp[0]['id'];
        return $user_id;
    }

    public function adminCheck() {
        $login = $this->session->userdata('user');
        if($login == "admin") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    ////////////////////////////////

    public function get_SubList() {

        $user_id = $this->user->getUserId();

        $this->db->select('*');
        $this->db->from('subscribes');
        $this->db->order_by('subscribes.id', 'DESC');
        $this->db->join('streams', 'streams.id = subscribes.stream_id');
        $this->db->where('subscribes.user_id', $user_id);
        $query = $this->db->get();

        return $query->result_array();

    }

    public function addToSubList($stream_id) {

        $user_id = $this->user->getUserId();

        $conditions = [
            'stream_id' => $stream_id,
            'user_id' => $user_id
        ];
        $res = $this->db->get_where('subscribes', $conditions);
        $arr = $res->result_array();
        
        if(count($arr) <= 0) 
        {

            $data = [
                'stream_id' => $stream_id,
                'user_id' => $user_id
            ];
            $this->db->insert('subscribes', $data);

            return TRUE;

        } else {

            return FALSE;

        }
    }

    public function delete_SubList_item($stream_id) {

        $user_id = $this->user->getUserId();

        $this->db->where('subscribes.stream_id', $stream_id);
        $this->db->where('subscribes.user_id', $user_id);
        $this->db->delete('subscribes');
        
    }


    ////////////////////////////////

    public function editStream($src) {
        $user_id = $this->user->getUserId();
        $data = array(
            'src' => $src
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('streams', $data);
    }

    public function getStreamInfo() {
        $user_id = $this->user->getUserId();
        $query = $this->db->get_where('streams', array('user_id' => $user_id));
        $res = $query->result_array();
        return $res[0];
    }

    public function generateRandomKey() {

        $length = 15;
        $symbols = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbolsLength = strlen($symbols);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $symbols[rand(0, $symbolsLength - 1)];
        }
        return $randomString;
    }
}