<?php
    $this->load->view('templates/header.php');
?>

    <head>
        <link href="<?=base_url('assets/css/signin.css')?>" rel="stylesheet">
    </head>
    
    <body class="text-center">
        <div class="form-signin">
            <?php if ($stat == 'succes') { ?>
                <img class="mb-4" src="<?=base_url('assets/images/icosuccess.ico')?>" alt="" width="72" height="72">
            <?php } else { ?>
                <img class="mb-4" src="<?=base_url('assets/images/icoerr.ico')?>" alt="" width="72" height="72">
            <?php } ?>
            <h1 class="h3 mb-3 font-weight-normal"><?=$mess?></h1>
            <?php if ($stat == 'succes') { ?>
                <?php if($type == 'category') { ?>
                    <a id="btn_result" href="<?=site_url('admin/categories')?>" class="btn btn-secondary"> OK </a>
                <?php } else { ?>
                    <a id="btn_result" href="<?=site_url('admin/producers')?>" class="btn btn-secondary"> OK </a>
                <?php } ?>
            <?php } else { ?>
                <?php if($type == 'category') { ?>
                    <div class="btn-group btn-group-toggle">
                        <a id="btn_result" href="<?=site_url('admin/categories')?>" class="btn btn-secondary"> ОК </a>
                        <a id="btn_result" href="<?=site_url('admin/add_category')?>" class="btn btn-secondary btn-info">Добавить категорию</a>
                    </div>
                <?php } else { ?>
                    <div class="btn-group btn-group-toggle">
                        <a id="btn_result" href="<?=site_url('admin/producers')?>" class="btn btn-secondary"> ОК </a>
                        <a id="btn_result" href="<?=site_url('admin/add_producer')?>" class="btn btn-secondary btn-info">Добавить производителя</a>
                    </div>
                <?php } ?>
            <?php } ?>
            <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Course Project 2018</p>
        </div>
  </body>
</html>
