<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Редактирование категории</h1>
    </div>
  </div>

  <div class="container">

    <form method="post" action="#" enctype="multipart/form-data">
      <p>
        <label for="cname">Название:</label><br>
        <input type="text" id="cname" name="cname" class="form-control" value="<?php echo $name ?>" style="width: 100%" required>
      </p>

      <hr>

      <p>
        <input class="btn btn-success" type="submit" id="submit" name="submit" value="Обновить категорию">
        &nbsp;
        <input class="btn btn-danger" type="reset" id="reset" name="reset" value="Отмена">
      </p>
    </form>

  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>