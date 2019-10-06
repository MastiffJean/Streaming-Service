<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="jumbotron">
    <div class="container">
      <h1 class="display-4">Добавление новости</h1>
    </div>
  </div>

  <div class="container">

    <form method="post" action="#" enctype="multipart/form-data">
      <p>
        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title" class="form-control" style="width: 100%" required>
      </p>

      <p>
        <label for="description">Описание:</label><br>
        <textarea type="text" id="description" name="description" class="form-control" rows="5" style="width: 100%" required></textarea>
      </p>

      <p>
        <label for="content">Содержание: (поддерживаются html-теги)</label><br>
        <textarea type="text" id="content" name="content" class="form-control" rows="10" style="width: 100%" required></textarea>
      </p>

      <p>
        <label for="image">Изображение:</label><br>
        <input type="file" id="image" name="image">
      </p>

      <hr>

      <p>
        <input class="btn btn-success" type="submit" id="submit" name="submit" value="Добавить новость">
        &nbsp;
        <input class="btn btn-danger" type="reset" id="reset" name="reset" value="Отмена">
      </p>
    </form>

  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>