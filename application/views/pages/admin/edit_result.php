<?php
    $this->load->view('templates/header.php');
?>

    <head>
        <link href="<?=base_url('assets/css/signin.css')?>" rel="stylesheet">
    </head>
    
    <body class="text-center">
        <div class="form-signin">
            <img class="mb-4" src="<?=base_url('assets/images/favicon.ico')?>" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal"><?=$mess?></h1>
            <?php if($type == 'good') { ?>
                <a id="btn_result" href="<?=site_url('admin/goods')?>" class="btn btn-secondary"> OK </a>
            <?php } elseif($type == 'news') { ?>
                <a id="btn_result" href="<?=site_url('admin/news')?>" class="btn btn-secondary"> OK </a>
            <?php } elseif($type == 'sale') { ?>
                <a id="btn_result" href="<?=site_url('admin/sale')?>" class="btn btn-secondary"> OK </a>
            <?php } elseif($type == 'category') { ?>
                <a id="btn_result" href="<?=site_url('admin/categories')?>" class="btn btn-secondary"> OK </a>
            <?php } else { ?>
                <a id="btn_result" href="<?=site_url('admin/producers')?>" class="btn btn-secondary"> OK </a>
            <?php } ?>
            <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Course Project 2018</p>
        </div>
  </body>
</html>
