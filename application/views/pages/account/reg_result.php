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
            <a id="btn_result" href="<?=site_url('home/index')?>" class="btn btn-secondary">На главную</a>
            <a id="btn_result" href="<?=site_url('account/entry')?>" class="btn btn-secondary btn-info">Вход</a>
        <?php } else { ?>
            <div class="btn-group btn-group-toggle">
                <a id="btn_result" href="<?=site_url('home/news')?>" class="btn btn-secondary"> ОК </a>
                <a id="btn_result" href="<?=site_url('account/reg')?>" class="btn btn-secondary btn-info">Регистрация</a>
            </div>
        <?php } ?>
        <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Diploma Project 2019</p>
    </div>
</body>
</html>