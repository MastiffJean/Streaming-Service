<?php
  $this->load->view('templates/header.php');
?>

<head>
  <link href="<?=base_url('assets/css/signin.css')?>" rel="stylesheet">
</head>

<body class="text-center">
  <form id="form2" action="<?= site_url('account/entry') ?>" method="post" class="form-signin">
    <img class="mb-4" src="<?=base_url('assets/images/favicon.ico')?>" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Вход</h1>

    <label for="login" class="sr-only">Логин</label>
    <input type="text" id="login" name="login" class="form-control" placeholder="Введите логин" required autofocus>

    <label for="pass1" class="sr-only">Пароль</label>
    <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Введите пароль" required>

    <input class="btn btn-lg btn-primary btn-block" id="submit" name="submit" value="Войти" type="submit">
    <p class="mt-5 mb-3 text-muted">&copy; Dmitry Bal - Diploma Project 2019</p>
  </form>
</body>
</html>
