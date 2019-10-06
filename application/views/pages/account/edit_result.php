<?php
    $this->load->view('templates/header.php');
?>

    <head>
        <link href="<?=base_url('assets/css/signin.css')?>" rel="stylesheet">
    </head>
    
    <body class="text-center">
        <div class="form-signin">
            <img class="mb-4" src="<?=base_url('assets/images/favicon.ico')?>" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Профиль изменен</h1>
            <a id="btn_result" href="<?=site_url('account/settings')?>" class="btn btn-secondary"> OK </a>
            <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Diploma Project 2019</p>
        </div>
  </body>
</html>
