<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
  $user = $this->session->userdata('user');
?>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      <h1 class="display-3">Категории</h1>
      <?php if ($user == 'admin') { ?>
        <p><a class="btn btn-outline-secondary" style="margin-top: 10px" href="<?=site_url('admin/add_category')?>" role="button">Добавить категорию &raquo;</a></p>
      <?php } ?>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <?php 
        $data['categories'] = $categories;
        $this->load->view('pages/streams/categories_items', $data); 
      ?>
    </div>
    <nav aria-label="Page navigation example">
      <?php echo $links; ?>
    </nav>
  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>