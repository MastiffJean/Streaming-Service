<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<head>
  <link href="<?=base_url('assets/css/carousel_shop.css')?>" rel="stylesheet">
</head>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      <h1 id="shop_info" class="display-4">Управление категориями</h1>
      <p><a class="btn btn-outline-secondary" style="margin-top: 10px" href="<?=site_url('admin/add_category')?>" role="button">Добавить категорию &raquo;</a></p>
    </div>
  </div>

  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div id="categories_list" class="row">
          <?php 
            $data['categories'] = $categories;
            $this->load->view('pages/admin/category_items', $data); 
          ?>
        </div>
        <nav aria-label="Page navigation example" style="margin-top: 20px">
          <?php echo $links; ?>
        </nav>
      </div>

    </div>
  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
</script>
<script type="text/javascript">

  $(document).ready(function() {
    $(document).on('click', '#delete_category_item', function(event) {
      event.preventDefault();
      let cid = $(this).attr("value");
      var isConfirm = confirm("Вы уверенны?");
      if (isConfirm == true) {
        var href = location.href;
        var cur_href = href.match(/([^\/]*)\/*$/)[1];
        if(cur_href == 'categories') {
          $.ajax({
            url: "delete_category",
            data: "category_id=" + cid,
            type: "POST",
            success: function() {
              location.reload();
            },
            error: function() {
              alert("Ошибка!");
            }
          });
        } else {
          $.ajax({
            url: "../delete_category",
            data: "category_id=" + cid,
            type: "POST",
            success: function() {
              location.reload();
            },
            error: function() {
              alert("Ошибка!");
            }
          });
        }
      }
    });
  })
</script>