<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      <h1 class="display-3">О сайте</h1>
    </div>
  </div>

  <div class="container">

    <div style="margin-bottom: 30px">
      <h4>Стриминг сервис Streams GO</h4>
      <hr>
      <p>Дипломный проект - Баль Дмитрий</p>
      <p>Сайт написан на PHP с использованием фреймворка Codeigniter и Bootstrap</p>
    </div>
    <div class="row">
      <a href="http://www.php.net" class="btn_del col">
        <img src="<?=base_url('assets/images/php.png')?>" style="max-height: 100px;" alt="">
      </a>
      <a href="https://www.mysql.com" class="btn_del col">
        <img src="<?=base_url('assets/images/mysql.png')?>" style="max-height: 100px;" alt="">
      </a>
      <a href="https://www.codeigniter.com" class="btn_del col">
        <img src="<?=base_url('assets/images/codeigniter.png')?>" style="max-height: 100px" alt="">
      </a>
      <a href="https://getbootstrap.com" class="btn_del col">
        <img src="<?=base_url('assets/images/bootstrap.png')?>" style="max-height: 100px" alt="">
      </a>

    </div>


  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>