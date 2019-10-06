<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      <h1 class="display-4">Управление сайтом</h1>
    </div>
  </div>

  <div class="container">

    <div class="row adm_btns">
      <a class="col btn btn-primary" href="<?=site_url('admin/categories')?>" role="button">Категории &raquo;</a>
      <a class="col btn btn-info" href="<?=site_url('admin/news')?>" role="button">Новости &raquo;</a>
    </div>

  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>