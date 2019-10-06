<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<head>
  <style>
  video {
    width: 100%;
    height: 100%;
    max-width: 426px;
    max-height: 240px;
  }
  </style>
</head>

  <main role="main">

  <div class="row" style="margin: 0px; margin-top: 8px">
    <div class="col-sm-9" style="padding: 0px">
      <div class="jumbotron jumbotron-fluid" style="padding: 1rem 1rem">
        <div class="container" style="display: flex">
          <h2 class="display-4" style="margin-right: 10px">Параметры трансляции:</h2>
        </div>
      </div>
      
      <div class="container">
        <div class="container">
          <video id="videoPlayer" controls muted="falce"></video>
        </div> <!-- /container -->
  
        <hr>

        <?php if($stream_status == 1){ ?>
          <h2 class="display-4">OFFLINE</h2>
        <?php } else { ?>
          <h2 class="display-4" style="color: red">ONLINE</h2>
        <?php } ?>

        <hr>

        <form action="<?php echo site_url('account/change_status');?>" method = "post">
          <?php if($stream_status == 1){ ?>
            <button type="submit" id="change" name="change" class="btn btn-danger btn-lg" value="ONLINE">Начать стрим</button>
          <?php } else { ?>
            <button type="submit" id="change" name="change" class="btn btn-danger btn-lg" value="OFFLINE">Закончить стрим</button>
          <?php } ?>
        </form>

        <hr>

        <form action="<?php echo site_url('account/change_settings');?>" method = "post">

          <p>
            <label for="sname">Название:</label><br>
            <input type="text" id="sname" name="sname" class="form-control" value="<?php echo $name ?>" style="width: 100%" required>
          </p>

          <p>
            <label for="description">Описание:</label><br>
            <textarea type="text" id="description" name="description" class="form-control" rows="5" style="width: 100%" required><?php echo $description ?></textarea>
          </p>

          <p>
            <label for="category">Категория:</label><br>
            <select type="text" id="category_id" name="category_id" class="form-control" style="width: 100%" required>
              <?php foreach ($categories as $category_item) { ?>
                <option value="<?php echo $category_item['id'] ?>"><?php echo $category_item['name']?></option>
              <?php } ?>
            </select>
          </p>

          <p>
            <input class="btn btn-success" type="submit" id="submit" name="submit" value="Обновить информацию">
            &nbsp;
            <input class="btn btn-danger" type="reset" id="reset" name="reset" value="Отмена">
          </p>
        </form>

        <hr>      

        <h2 class="display-4">Настройка видеокодера</h2>

        <p>
          <label for="sname">URL-адрес сервера:</label><br>
          <input type="text" id="sname" name="sname" class="form-control" value="<?php echo $rtmpServer ?>" style="width: 100%" required>
        </p>

        <p>
          <label for="sname">Название/ключ трансляции:</label><br>
          <input type="text" id="sname" name="sname" class="form-control" value="<?php echo $streamKey ?>" style="width: 100%" required>
        </p>
    
      </div> <!-- /container -->
    </div>
      <div class="col-sm-3" style="padding: 0px">
        <div id="page-wrap2" class="" style="">
          <div class="jumbotron jumbotron-fluid" style="padding: 1rem 1rem; text-align: center; margin-bottom: 0px">
            <h2 class="display-4" >Чат:</h2>
          </div>
          
          
          <div class="chat" style="padding: 10px">
              <div id="chatOutput" style="padding: 10px;"></div>
              <input id="chatInput" class="form-control" type="text" maxlength="150" style="">
              <button id="chatSend" class="btn btn-info" value="<?php echo $id ?>">Send</button>
          </div>
        </div>
      </div>
  </div>
  </main>

<?php
  $this->load->view('templates/footer.php');
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
</script>
<script type="text/javascript">

  $(document).ready(function() {

    var d = new Date();
    

    var month = String(d.getMonth() + 1);
    if (month.length == 1) {
        month = "0" + month;
    }
    var day = String(d.getDate());
    if (day.length == 1) {
        day = "0" + day;
    }
    var hour = String(d.getHours());
    if (hour.length == 1) {
        hour = "0" + hour;
    }
    var minute = String(d.getMinutes());
    if (minute.length == 1) {
        minute = "0" + minute;
    }
    var second = String(d.getSeconds());
    if (second.length == 1) {
        second = "0" + second;
    }

    var date = d.getFullYear()+"-"+month+"-"+day+
    " "+hour+":"+minute+":"+second;

    var chatInterval = 1000; //refresh interval in ms
    var $chatOutput = $("#chatOutput");
    var stream_id = $('#chatSend').attr("value");

    function retrieveMessages() {
        $.get("<?php echo site_url('home/get_message');?>?date="+date+"&stream="+stream_id, function(data) {
            $chatOutput.html(data); //Paste content into chat output
        });
    }

    setInterval(function() {
        retrieveMessages();
    }, chatInterval);

    $(document).on('click', '#chatSend', function(event) {
      event.preventDefault();
      let sid = $(this).attr("value");
      let text = $('#chatInput').val();
      console.log(sid);
      console.log(text);
      if(text != "") {
        $.ajax({
          url: "../home/send_message",
          data: {stream: sid, text: text},
          type: "POST",
          dataType: 'json'
        });
      }
      $('#chatInput').val('');
    });
  })
</script>
<script src="<?=base_url('assets/js/dash.all.min.js')?>"></script>
<script type="text/javascript">
  var key = '<?php echo $streamKey ?>';
  (function(){
    var url = "http://40.118.91.40/dash/"+key+".mpd";
    // var url = "http://127.0.0.1:8090/dash/"+key+".mpd";
    var player = dashjs.MediaPlayer().create();
    player.initialize(document.querySelector("#videoPlayer"), url, true);
    // player.setAutoPlay(true);

  })();
</script>
