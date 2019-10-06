<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Добавление категории</h1>
    </div>
  </div>

  <div class="container">

    <form method="post" action="#" enctype="multipart/form-data">
      <p>
        <label for="cname">Название:</label><br>
        <input type="text" id="cname" name="cname" class="form-control" style="width: 100%" required>
      </p>

      <p>
        <label class="h5 mb-3 font-weight-normal" for="image">Изображение категории</label><br>
        <input type="file" id="image" name="image">
      </p>

      <hr>

      <p>
        <input class="btn btn-success" type="submit" id="submit" name="submit" value="Добавить категорию">
        &nbsp;
        <input class="btn btn-danger" type="reset" id="reset" name="reset" value="Отмена">
      </p>
    </form>

  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>