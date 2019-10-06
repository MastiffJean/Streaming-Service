<?php

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('stream');
    }

    public function entry() {
        $data['title'] = 'Streams GO | Вход';

        $submit = $this->input->post('submit');
        if (!$submit) {
            return $this->load->view('pages/account/entry', $data);
        } else {
            $data['errors'] = 'nicht';

            $login = $this->input->post('login');
            $pass1 = $this->input->post('pass1');

            $password = md5($pass1);

            $res = $this->user->checkUser($login, $password);

            if ($res == TRUE) {
                $data['stat'] = 'succes';
                $data['mess'] = 'Авторизация успешна';
                $this->session->set_userdata('user', $login);
            } else {
                $data['stat'] = 'failed';
                $data['mess'] = 'Ошибка авторизации';
            }

            return $this->load->view('pages/account/entry_result', $data);
        }
    }

    public function reg() {
        $data['title'] = 'Streams GO | Регистрация';

        $submit = $this->input->post('submit');
        if (!$submit) {
            return $this->load->view('pages/account/reg', $data);
        } else {
            $data['errors'] = 'nicht';

            $login = $this->input->post('login');
            $pass1 = $this->input->post('pass1');
            $pass2 = $this->input->post('pass2');
            $email = $this->input->post('email');

            $res = $this->user->checkLoginIsFree($login);

            if ($res == TRUE) {
                if ($pass1 != $pass2) {
                    $data['stat'] = 'failed';
                    $data['mess'] = 'Пароли не совпадают';
                    $data['title'] = 'Streams GO | Ошибка регистрации';
                } else {
                    $password = md5($pass1);
                    $regdate = date('Y-m-d H:i:s');

                    $image = 'default.png';

                    $this->user->addUser($login, $password, $email, $regdate, $image);
                    $this->stream->add_stream($login);
                    $data['stat'] = 'succes';
                    $data['mess'] = 'Регистрация успешна';
                    $data['title'] = 'Streams GO | Регистрация успешна';
                }
            } else {
                $data['stat'] = 'failed';
                $data['mess'] = 'Пользователь с таким ником уже существует';
                $data['title'] = 'Streams GO | Ошибка регистрации';
            }

            return $this->load->view('pages/account/reg_result', $data);
        }
    }

    public function exits() {
        $data['title'] = 'Streams GO | Выход';
        $this->session->sess_destroy();
        return $this->load->view('pages/account/exits', $data);
    }

    public function profile() {
        $data['user'] = $this->user->getUserInfo();
        $data['title'] = 'Streams GO | '.$data['user']['login'];
        $data['stream'] = $this->user->getStreamInfo();
        $data['category'] = $this->stream->get_category_by_id($data['stream']['category_id'])[0];
        $data['user_info'] = $this->user->getUserInfo();

        return $this->load->view('pages/account/profile', $data);
    }

    public function test_live() {
        $data['user'] = $this->user->getUserInfo();
        $data['title'] = 'Streams GO | Test Live';
        $data['user_info'] = $this->user->getUserInfo();

        return $this->load->view('pages/account/test_live', $data);
    }

    public function settings() {
        $data['title'] = 'Streams GO | Настройки';
        $data['user'] = $this->user->getUserInfo();
        $data['user_info'] = $this->user->getUserInfo();

        return $this->load->view('pages/account/settings', $data);
    }

    public function stream_settings() {
        $data['title'] = 'Streams GO | Настройки трансляции';

        $user = $this->user->getUserInfo();
        $stream = $this->user->getStreamInfo();
        $category = $this->stream->get_categories();

        $data['id'] = $stream['id'];
        $data['rtmpServer'] = 'rtmp://40.118.91.40/dash';
        $data['streamKey'] = $user['stream_key'];
        $data['name'] = $stream['name'];
        $data['description'] = $stream['description'];
        $data['categories'] = $this->stream->get_categories();
        $data['status'] = $this->stream->get_statuses();
        $data['stream_status'] = $stream['status_id'];
        $data['user_info'] = $this->user->getUserInfo();

        $stream_id = $stream['id'];

        return $this->load->view('pages/account/stream_settings', $data);

    }

    public function change_settings() {

        $stream = $this->user->getStreamInfo();
        $stream_id = $stream['id'];

        $name = $this->input->post('sname');
        $description = $this->input->post('description');
        $category_id = $this->input->post('category_id');

        $this->stream->edit_stream($stream_id, $name, $description, $category_id);

        return $this->stream_settings();
    }

    public function change_status() {

        $stream = $this->user->getStreamInfo();
        $stream_id = $stream['id'];

        $status = $this->input->post('change');

        if($status == 'ONLINE') {
            $this->stream->edit_status($stream_id, 2);
        } else {
            $this->stream->edit_status($stream_id, 1);
        }

        return $this->stream_settings();
    }

    public function edit_email() {
        $data['title'] = 'Streams GO | Смена Email';
        $data['user_info'] = $this->user->getUserInfo();

        $user = $this->user->getUserInfo();

        $data['email'] = $user['email'];

        $submit = $this->input->post('submit');
        if (!$submit) {
            return $this->load->view('pages/account/edit_email', $data);
        } else {
            $data['errors'] = 'nicht';

            $email = $this->input->post('email');

            $this->user->edit_email($user['id'], $email);

            return $this->load->view('pages/account/edit_result', $data);
        }
    }

    public function edit_image() {
        $data['title'] = 'Streams GO | Смена изображения';
        $data['user_info'] = $this->user->getUserInfo();

        $user = $this->user->getUserInfo();

        $submit = $this->input->post('submit');
        if (!$submit) {
            return $this->load->view('pages/account/edit_image', $data);
        } else {
            $data['errors'] = 'nicht';


            $dir_path = 'assets/user_img/';

            $file_name = $_FILES['image']['name'];
            $file_type = $_FILES['image']['type'];
            
            $ext = explode('.',$_FILES['image']['name']);
            $extension = $ext[1];

            $translit_name = $this->translit($user['login']);

            $image = $translit_name.'.'.$extension;

            $file_path = $dir_path.$image;

            copy($_FILES['image']['tmp_name'], $file_path);

            $this->user->edit_image($user['id'], $image);

            return $this->load->view('pages/account/edit_result', $data);
        }
    }

    



    public function translit($s) {

      $s = (string) $s; // преобразуем в строковое значение
      $s = trim($s); // убираем пробелы в начале и конце строки
      $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
      $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>'', ' ' => '_', '/' => '_', ':' => '', '«' => '', '»' => '', '—' => '-', '"' => '', '?' => '', '–' => '-'));
      return $s; // возвращаем результат
    }

}
