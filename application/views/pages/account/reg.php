<?php
  $this->load->view('templates/header.php');
?>

<head>
  <link href="<?=base_url('assets/css/reg.css')?>" rel="stylesheet">
</head>

<body class="text-center">
  <form id="form1" action="<?= site_url('account/reg') ?>" method="post" class="form-signin" enctype='multipart/form-data'>
    <img class="mb-4" src="<?=base_url('assets/images/favicon.ico')?>" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>

    <label for="login" class="sr-only">Логин</label>
    <input type="text" id="login" name="login" class="form-control" placeholder="Введите логин" required autofocus>

    <label for="pass1" class="sr-only">Пароль</label>
    <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Введите пароль" required>

    <label for="pass2" class="sr-only">Подтвердите пароль</label>
    <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Подтвердите пароль" required>

    <label for="email" class="sr-only">Email адрес</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email адрес" required>

    <input class="btn btn-lg btn-primary btn-block" id="submit" name="submit" value="Зарегистрироваться" type="submit">
    <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Diploma Project 2019</p>
  </form>
</body>
</html>
