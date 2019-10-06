 <?php

 class Home extends CI_Controller
 {

    public function __construct() {

        parent::__construct();
        $this->load->model('user');
        $this->load->model('news');
        $this->load->model('stream');
    }

    // **
    // MAIN
    // **

    public function index() {

        $data['title'] = 'Streams GO';
        $data['streams'] = $this->stream->get_streams_count_main();
        $data['users'] = $this->user->getUsers();
        $data['user_info'] = $this->user->getUserInfo();
        $data['categories'] = $this->stream->get_categories_6();
        $data['another_news'] = $this->news->get_last_news();
        
        return $this->load->view('pages/home/index', $data);
    }

    public function streams() {

        $config = array();
        $config['base_url'] = base_url() . 'home/streams/';
        $config["total_rows"] = $this->stream->record_streams_count();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["streams"] = $this->stream->
            fetch_streams($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $data['title'] = 'Streams GO | Популярное';
        $data['users'] = $this->user->getUsers();
        $data['user_info'] = $this->user->getUserInfo();
        $data['cat'] = 'no';
        
        return $this->load->view('pages/home/streams', $data);
    }

    public function streams_category() {

        $category_id = $this->input->get('category_id');


        $config = array();
        $config['base_url'] = base_url() . 'home/streams/';
        $config["total_rows"] = $this->stream->record_streams_count_by_category($category_id);
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["streams"] = $this->stream->
            fetch_streams_by_category($config["per_page"], $page, $category_id);
        $data["links"] = $this->pagination->create_links();
        $data['category'] = $this->stream->get_category_info($category_id);
        $data['title'] = 'Streams GO | '.$data['category']['name'];
        $data['users'] = $this->user->getUsers();
        $data['user_info'] = $this->user->getUserInfo();
        $data['cat'] = 'yes';
        
        return $this->load->view('pages/home/streams', $data);
    }

    public function categories() {

        $config = array();
        $config['base_url'] = base_url() . 'home/categories/';
        $config["total_rows"] = $this->stream->record_category_count();
        $config["per_page"] = 8;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["categories"] = $this->stream->
            fetch_category($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $data['title'] = 'Streams GO | Категории';
        // $data['users'] = $this->user->getUsers();
        $data['user_info'] = $this->user->getUserInfo();
        // $data['cat'] = 'no';
        
        return $this->load->view('pages/home/categories', $data);
    }

    public function stream() {

        $stream_id = $this->input->get('id');
        $stream = $this->stream->get_stream($stream_id);

        $data['user'] = $this->user->getUserInfoById($stream['user_id']);
        $data['title'] = 'Streams GO | '.$data['user']['login'];
        $data['stream'] = $stream;
        $data['category'] = $this->stream->get_category_by_id($data['stream']['category_id'])[0];
        $data['user_info'] = $this->user->getUserInfo();
        
        return $this->load->view('pages/home/stream', $data);
    }



    public function about() {

        $data['title'] = 'Streams GO | О сайте';
        $data['user_info'] = $this->user->getUserInfo();

        return $this->load->view('pages/home/about', $data);
    }

    public function contacts() {

        $data['title'] = 'Streams GO | Контакты';
        $data['user_info'] = $this->user->getUserInfo();

        return $this->load->view('pages/home/contacts', $data);
    }

    public function search_keyword() {

        $name = $this->input->post('keyword');

        $data['title'] = 'Streams GO | Поиск: '.$name;
        $data['keyword'] = $name;
        $data['users'] = $this->stream->search_streams($name);
        $data['streams'] = $this->stream->get_streams_all();
        $data['user_info'] = $this->user->getUserInfo();

        $this->load->view('pages/home/search', $data);
    }

    // **
    // END MAIN
    // **

    // #############################################################################

    // **
    // NEWS
    // **

    public function news() {

        $config = array();
        $config['base_url'] = base_url() . 'home/news/';
        $config["total_rows"] = $this->news->record_news_count();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["news"] = $this->news->
            fetch_news($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $data['title'] = 'Streams GO | Новости и статьи';
        $data['user_info'] = $this->user->getUserInfo();

        return $this->load->view("pages/home/news", $data);
    }

    public function news_details() {

        $news_id = $this->input->get('id');
        $news = $this->news->get_news_by_id($news_id);

        $data['title'] = 'Streams GO | '.$news[0]['title'];
        $data['user_info'] = $this->user->getUserInfo();
        $data['news'] = $news[0];
        $data['another_news'] = $this->news->get_rand_news($news_id);
        return $this->load->view('pages/news/news_details', $data);
    }

    // **
    // END NEWS
    // **

    // #############################################################################

    // **
    // WISHLIST
    // **

    public function send_message() {

        $stream_id = $this->input->post('stream');
        $text = $this->input->post('text');
        $this->stream->sendMessage($stream_id, $text);
    }

    public function get_message() {


        $stream_id = $_REQUEST['stream'];
        $date = $_REQUEST['date'];

        $res = $this->stream->getMessage($stream_id, $date);

        if ($res != NULL) {

            foreach ($res as $row) {

                $user_id=$row["user_id"];
                $user = $this->user->getUserInfoById($user_id);
                $name = $user['login'];
                $text=$row["text"];

                echo "<p>$name: $text</p>";
            }
        }

    }

    public function add_to_sub_list() {

        $stream_id = $this->input->post('stream_id');
        $res = $this->user->addToSubList($stream_id);
        if($res == TRUE) {
            echo json_encode('OK');            
        }
        if($res == FALSE) {
            echo json_encode('FALSE');
        }
    }

    public function subscribers() {

        $data['title'] = 'Streams GO | Отслеживаемое';
        $data['streams'] = $this->user->get_SubList();
        $data['users'] = $this->user->getUsers();
        $data['user_info'] = $this->user->getUserInfo();

        $this->load->view('pages/home/subscribers', $data);
    }

    public function delete_subscribers_item() {

        $stream_id = $this->input->post('stream_id');
        $this->user->delete_SubList_item($stream_id);
    }


    public function update_sub_items() {

        $data['streams'] = $this->user->get_SubList();
        $data['users'] = $this->user->getUsers();
        return $this->load->view('pages/subscribers/subscribers_item', $data);
    }

    // **
    // END WISHLIST
    // **

 }