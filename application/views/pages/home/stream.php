<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>
<head>
  <style>
  video {
       width: 100%;
       height: 100%;
       max-height: 70vh;
  }
  .btn_wrap {
  height: 44px;
  width: 55px;
  transition: 0.4s ease-in-out;
  overflow:hidden;
  opacity: 0.9;
  }

  .btn_wrap:hover
  {
      width: 170px;
      opacity: 1; 
  }

  
  </style>
</head>

  <main role="main">
    <div class="row" style="margin: 0px; margin-top: 8px">
      <div class="col-sm-9" style="padding: 0px">
        <div class="jumbotron jumbotron-fluid" style="padding: 1rem 1rem; margin-bottom: 0;">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <div class="container" style="display: flex">
              <img src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" style="margin-right: 30px" alt="" width="55" height="55">
              <h1 class="display-4" style="font-size: 40px"><?php echo $user['login'] ?></h1>
            </div>
            <div class="container" style="text-align: right; ">
              <a id="add_sub" class="btn btn-primary btn_wrap" role="button" value="<?php echo $stream['id'] ?>" href="#" title="Отслеживать">
                <img class="btn_img" src="<?=base_url('assets/images/like_btn.png')?>" width="30" height="30" alt="Отслеживать" style="margin-right: 15px">
                <div class="btn_content">
                  <div class="btn_hover"style="margin-right: 25px">Отслеживать</div>
                </div>
              </a>
            </div>
          </div>
          
        </div>
        <div class="container" style="padding: 0px; margin-bottom: 0px">
          <video id="videoPlayer" controls muted="falce"></video>
        </div> <!-- /container -->
        
      </div>
      <div class="col-sm-3" style="padding: 0px">
        <div id="page-wrap2" class="" style="">
          <div class="jumbotron jumbotron-fluid" style="padding: 1rem 1rem; text-align: center; margin-bottom: 0px">
            <h1 class="display-4" style="font-size: 40px">Чат трансляции:</h1>
          </div>
          
          
          <div class="chat" style="padding: 10px">
              <div id="chatOutput" style="padding: 10px;"></div>
              <input id="chatInput" class="form-control" type="text" maxlength="150" style="">
              <button id="chatSend" class="btn btn-info" value="<?php echo $stream['id'] ?>">Send</button>
          </div>
        </div>
      </div>
      
    </div>
    <div class="jumbotron jumbotron-fluid" style="padding: 1rem 1rem; margin-top: -6px;">        
        <div class="container" style="display: flex; margin-left: 0px">
          <a href="<?php echo site_url('home/streams_category');?>?category_id=<?php echo $category["id"] ?>" >
            <img src="<?=base_url('assets/category_img/')?><?php echo $category['image'] ?>" style="margin-right: 30px" alt="" width="70" height="70">
          </a>
          
          <h1 class="display-4"><?php echo $stream['name'] ?></h1>
        </div>
        </div>
        <div class="container" style="margin-left: 0px">
          <p>
            <?php echo $stream['description'] ?>
          </p>
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
          url: "send_message",
          data: {stream: sid, text: text},
          type: "POST",
          dataType: 'json'
        });
      }
      $('#chatInput').val('');
    });
    $(document).on('click', '#add_sub', function(event) {
      event.preventDefault();
      let sid = $(this).attr("value");
      $.ajax({
        url: "add_to_sub_list",
        data: "stream_id=" + sid,
        type: "POST",
        dataType: 'json',
        success: function(result) {
          if(result == 'OK') {
            alert("Стример добавлен в список отслеживаемого");
          }
          if(result == 'FALSE') {
            alert("Стример уже добавлен в список отслеживаемого");
          }
        },
        error: function() {
          alert("Ошибка!");
        }
      });
    });
  })
</script>
<script src="<?=base_url('assets/js/dash.all.min.js')?>"></script>
<script type="text/javascript">
  var key = '<?php echo $user['stream_key'] ?>';
  var status = '<?php echo $stream['status_id'] ?>';
  if(status == 2){
    (function(){
    var url = "http://40.118.91.40/dash/"+key+".mpd";
    // var url = "http://127.0.0.1:8090/dash/"+key+".mpd";
    var player = dashjs.MediaPlayer().create();
    player.initialize(document.querySelector("#videoPlayer"), url, true);
    })();
  } else {
    document.getElementById("videoPlayer").setAttribute("poster", "<?=base_url('assets/images/offline_poster.jpg')?>");
  }
  
</script>



