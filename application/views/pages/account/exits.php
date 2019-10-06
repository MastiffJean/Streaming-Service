<?php
    $this->load->view('templates/header.php');
?>

<head>
    <link href="<?=base_url('assets/css/signin.css')?>" rel="stylesheet">
</head>

<body class="text-center">
    <div class="form-signin">
        <img class="mb-4" src="<?=base_url('assets/images/icowrn.ico')?>" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Вы вышли из системы</h1>
        <div class="btn-group btn-group-toggle">
            <a id="btn_result" href="<?=site_url('home/index')?>" class="btn btn-secondary btn-warning">На главную</a>
            <a id="btn_result" href="<?=site_url('account/entry')?>" class="btn btn-secondary">Вход</a>
            <a id="btn_result" href="<?=site_url('account/reg')?>" class="btn btn-secondary btn-info">Регистрация</a>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Diploma Project 2019</p>
    </div>
</body>
</html>
