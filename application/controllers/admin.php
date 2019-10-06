<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('news');
        $this->load->model('stream');
        $this->load->model('admin_model');
    }

    public function admin() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $data['title'] = 'Streams GO | Управление сайтом';
            $data['user_info'] = $this->user->getUserInfo();

            return $this->load->view('pages/admin/admin', $data);

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    // #############################################################################

    // **
    // NEWS
    // **

    public function news() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $config = array();
            $config['base_url'] = base_url() . 'admin/news/';
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

            $data['title'] = 'Streams GO | Управление новостями';
            $data['user_info'] = $this->user->getUserInfo();

            return $this->load->view("pages/admin/news", $data);

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function add_news() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $data['title'] = 'Streams GO | Добавление новости';
            $data['user_info'] = $this->user->getUserInfo();

            $submit = $this->input->post('submit');
            if (!$submit) {
                return $this->load->view('pages/news/add_news', $data);
            } else {
                $data['errors'] = 'nicht';

                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $content = $this->input->post('content');

                $dir_path = 'assets/news_img/';
                

                $file_name = $_FILES['image']['name'];
                $file_type = $_FILES['image']['type'];
                
                $ext = explode('.',$_FILES['image']['name']);
                $extension = $ext[1];

                $translit_name = $this->translit($title);

                $image = $translit_name.'.'.$extension;

                $file_path = $dir_path.$image;

                copy($_FILES['image']['tmp_name'], $file_path);


                $publish = date('Y-m-d H:i:s');
                $status = 'norm';

                $res = $this->admin_model->add_news($title, $description, $content, $image, $publish, $status);

                if ($res == TRUE) {
                    $data['stat'] = 'succes';
                    $data['mess'] = 'Новость добавлена';
                    $data['title'] = 'Streams GO | Новость добавлена';

                } else {
                    $data['stat'] = 'failed';
                    $data['mess'] = 'Ошибка добавления';
                    $data['title'] = 'Streams GO | Ошибка добавления';
                }

                return $this->load->view('pages/news/add_result', $data);
            }

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function edit_news() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $data['title'] = 'Streams GO | Редактирование новостии';
            $data['user_info'] = $this->user->getUserInfo();

            $news_id = $this->input->get('id');
            $news = $this->news->get_news_by_id($news_id);

            $data['title'] = $news[0]['title'];
            $data['description'] = $news[0]['description'];
            $data['content'] = $news[0]['content'];

            $submit = $this->input->post('submit');
            if (!$submit) {
                return $this->load->view('pages/admin/edit_news', $data);
            } else {
                $data['errors'] = 'nicht';

                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $content = $this->input->post('content');

                $this->admin_model->edit_news($news_id, $title, $description, $content);

                $data['title'] = 'Streams GO | Новость обновлена';
                $data['mess'] = 'Новость обновлена';
                $data['type'] = 'news';
                return $this->load->view('pages/admin/edit_result', $data);
            }

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function delete_news() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $news_id = $this->input->post('news_id');
            $this->admin_model->delete_news($news_id);

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function update_news_items() {

        $data['news'] = $this->news->get_news();

        return $this->load->view('pages/admin/news_items', $data);
    }

    // **
    // END NEWS
    // **

    // #############################################################################

    // **
    // CATEGORIES
    // **

    public function categories() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $config = array();
            $config['base_url'] = base_url() . 'admin/categories/';
            $config["total_rows"] = $this->stream->record_category_count();
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
            $data["categories"] = $this->stream->
                fetch_category($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $data['title'] = 'Streams GO | Категории';
            $data['user_info'] = $this->user->getUserInfo();

            return $this->load->view("pages/admin/categories", $data);
        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function add_category() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $data['title'] = 'Streams GO | Добавление категории';
            $data['user_info'] = $this->user->getUserInfo();

            $submit = $this->input->post('submit');
            if (!$submit) {
                return $this->load->view('pages/admin/add_category', $data);
            } else {
                $data['errors'] = 'nicht';

                $cname = $this->input->post('cname');

                $dir_path = 'assets/category_img/';

                $file_name = $_FILES['image']['name'];
                $file_type = $_FILES['image']['type'];
                
                $ext = explode('.',$_FILES['image']['name']);
                $extension = $ext[1];

                $translit_name = $this->translit($cname);

                $image = $translit_name.'.'.$extension;

                $file_path = $dir_path.$image;

                copy($_FILES['image']['tmp_name'], $file_path);

                $res = $this->admin_model->add_category($cname, $image);

                if ($res == TRUE) {
                    $data['stat'] = 'succes';
                    $data['mess'] = 'Категория добавлена';
                    $data['title'] = 'Streams GO | Категория добавлена';
                    $data['type'] = 'category';
                } else {
                    $data['stat'] = 'failed';
                    $data['mess'] = 'Ошибка добавления';
                    $data['title'] = 'Streams GO | Ошибка добавления';
                    $data['type'] = 'category';
                }

                return $this->load->view('pages/admin/add_result', $data);

            }

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function edit_category() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $data['title'] = 'Streams GO | Редактирование категории';
            $data['user_info'] = $this->user->getUserInfo();

            $category_id = $this->input->get('id');
            $category = $this->stream->get_category_by_id($category_id);

            $data['name'] = $category[0]['name'];

            $submit = $this->input->post('submit');
            if (!$submit) {
                return $this->load->view('pages/admin/edit_category', $data);
            } else {
                $data['errors'] = 'nicht';

                $name = $this->input->post('cname');

                $this->admin_model->edit_category($category_id, $name);

                $data['title'] = 'Streams GO | Категория обновлена';
                $data['mess'] = 'Категория обновлена';
                $data['type'] = 'category';
                return $this->load->view('pages/admin/edit_result', $data);
            }

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function delete_category() {

        $res = $this->user->adminCheck();

        if ($res == TRUE) {

            $category_id = $this->input->post('category_id');
            $this->admin_model->delete_category($category_id);

        } else {

            $data['title'] = 'Streams GO | Доступ ограничен';
            return $this->load->view('pages/account/access_eror', $data);
        }
    }

    public function update_category_items() {

        $data['categories'] = $this->stream->get_categories();
        return $this->load->view('pages/admin/category_items', $data);
    }

    // **
    // END CATEGORIES
    // **

    // #############################################################################

    // **
    // OTHERS
    // **

    public function translit($s) {

      $s = (string) $s; // преобразуем в строковое значение
      $s = trim($s); // убираем пробелы в начале и конце строки
      $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
      $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>'', ' ' => '_', '/' => '_', ':' => '', '«' => '', '»' => '', '—' => '-', '"' => '', '?' => '', '–' => '-'));
      return $s; // возвращаем результат
    }

    

    // **
    // END OTHER
    // **
}
