<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
  $user = $this->session->userdata('user');
?>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem">
    <div class="container">
      <h1 class="display-4">Управление новостями</h1>
    </div>
  </div>

  <div class="container-fluid">
    <div id="news_list" class="row">
      <?php 
      $data['news'] = $news;
      $this->load->view('pages/admin/news_items', $data); 
      ?>
    </div>
    <nav aria-label="Page navigation example">
      <?php echo $links; ?>
    </nav>
  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
</script>
<script type="text/javascript">

  $(document).ready(function() {
    $(document).on('click', '#delete_news', function(event) {
      event.preventDefault();
      let nid = $(this).attr("value");
      var isConfirm = confirm("Вы уверенны?");
      if (isConfirm == true) {
        var href = location.href;
        var cur_href = href.match(/([^\/]*)\/*$/)[1];
        if(cur_href == 'news') {
          $.ajax({
            url: "delete_news",
            data: "news_id=" + nid,
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
            url: "../delete_news",
            data: "news_id=" + nid,
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