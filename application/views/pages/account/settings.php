<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

  <main role="main">

    <div class="jumbotron">
      <div class="container" style="display: flex">
        <img src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" style="margin-right: 30px" alt="" width="100" height="100">
        <h1 class="display-3"><?php echo $user['login'] ?></h1>
      </div>
    </div>

    <div class="container">
      <a class="btn btn-primary btn_like" href="<?php echo site_url('account/edit_image');?>?id=<?php echo $user['id'] ?>" role="button" title="Редактировать"style="margin-right: 10px">
        <div class="btn_content">
          <div class="btn_hover"style="margin-right: 10px">Изменить изображение</div>
        </div>
        <img src="<?=base_url('assets/images/edit.png')?>" width="20" height="20" alt="edit">
      </a>
      <br>
      <br>
      <h2 class="display-4" style="font-size: 40px">Email: <?php echo $user['email'] ?></h2>
      <a class="btn btn-primary btn_like" href="<?php echo site_url('account/edit_email');?>?id=<?php echo $user['id'] ?>" role="button" title="Редактировать"style="margin-right: 10px">
        <div class="btn_content">
          <div class="btn_hover"style="margin-right: 10px">Изменить Email</div>
        </div>
        <img src="<?=base_url('assets/images/edit.png')?>" width="20" height="20" alt="edit">
      </a>
      <hr>
      <p>Дата регистрации: <?php echo $user['regdate'] ?></p>
    </div> <!-- /container -->

  </main>

<?php
  $this->load->view('templates/footer.php');
?>