<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="container-fluid" style="margin-top: 20px">

    <div class="row news_details">
      <div class="col-sm-9">
        <div class="jumbotron news_jumb">
          <img src="<?=base_url('assets/news_img/')?><?php echo $news['image'] ?>" class="img-fluid" style="margin: 0px;" alt="Responsive image">
          <h1 class="display-3 col" style="font-size: 40px"><?php echo $news['title'] ?></h1>
        </div>
        <div class="news_content">
          <?php echo $news['content'] ?>
          <hr>
          <p><?php echo $news['publish'] ?></p>
          <a class="btn btn-info" href="<?=site_url('home/news')?>">К другим новостям &raquo;</a>
        </div>
      </div>

      <div class="col-sm-3" id="sidebar" role="navigation">
        <div class="list-group" id="list-news">
          <?php 
          $data['news'] = $another_news;
          $this->load->view('pages/news/news_items_side', $data); 
          ?>
        </div>
      </div>

    </div>
  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>