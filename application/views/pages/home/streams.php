<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
  $user = $this->session->userdata('user');
?>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      
      <?php if ($cat == 'yes') { ?>
        <!-- <p><a class="btn btn-outline-secondary" style="margin-top: 10px" href="<?=site_url('admin/add_news')?>" role="button">Добавить новость &raquo;</a></p> -->
        <div style="display: flex;">
          <img src="<?=base_url('assets/category_img/')?><?php echo $category['image'] ?>" style="margin-right: 30px" alt="" width="90" height="90">
          <h1 class="display-3"><?php echo $category['name'] ?></h1>
        </div>
      <?php } else { ?>
        <h1 class="display-3"><i class="fab fa-hotjar" style="margin-right: 20px"></i>Популярное</h1>
      <?php } ?>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <?php 
        $data['streams'] = $streams;
        $data['users'] = $users;
        $this->load->view('pages/streams/stream_items', $data); 
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