<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<head>
  <link href="<?=base_url('assets/css/carousel_shop.css')?>" rel="stylesheet">
</head>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      <h1 id="shop_info" class="display-3">Поиск: <?php echo $keyword ?></h1>
      <?php 
      $data['count'] = count($users);
      $this->load->view('pages/search/search_info', $data);
      ?>
    </div>
  </div>

  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div id="stream_list" class="row">
          <?php 
            $data['users'] = $users;
            $data['streams'] = $streams;
            $this->load->view('pages/search/search_item', $data); 
          ?>
        </div>
      </div>

    </div>
  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
</script>