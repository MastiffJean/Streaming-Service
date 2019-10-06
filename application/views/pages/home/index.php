<?php
$this->load->view('templates/header.php');
$this->load->view('templates/nav.php');
?>

<head>
  <link href="<?=base_url('assets/css/carousel_main.css')?>" rel="stylesheet">
</head>

<style>
  .video_element {
    margin: 10px;
    /*height: 300px;
    width: 300px;*/
    position: relative;
  }

  .video_element .over_video {
    display: flex;
    position: absolute;
    width: 100%;
    height: 50%;
    left: 5px;
    top: 5px;
    text-align: left;
    color: white;
    text-shadow: 1px 1px 2px black, 0 0 1em black;
  }
</style>

<main role="main">
  <div class="container-fluid">
      <div style="padding: 0px; padding-top: .53rem">
        <div id="sale_list" class="row">
          <div id="myCarousel" class="carousel slide shadow-sm" data-ride="carousel" data-interval="0" style="background-color: #ccd5db">
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="text-align: center; ">
              <div class="carousel-item active">
                <div style="display: flex; justify-content: center;" >
                  <div class="video_element" style="margin: 0px">
                      <?php foreach ($users as $user) { ?>
                        <?php if($user['id'] == $streams[0]['user_id']) { ?>
                          <video class="" id="videoPlayer1" controls muted="false" value="<?php echo $user['stream_key'] ?>" style="max-height: 50vh; max-width: 100%; padding: 0px"></video>
                          <div class="over_video">
                          <img src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" style="margin-right: 20px; border-radius: 5px;" alt="" width="80" height="80">
                          <div style="">
                            <a class="card-text good_link" style="font-size: 30px" href="<?php echo site_url('home/stream');?>?id=<?php echo $streams[0]["id"] ?>"><?php echo $streams[0]['name'] ?></a>
                            <h1 class="display-4" style="font-size: 25px"><?php echo $user['login'] ?></h1>
                          </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div style="display: flex; justify-content: center;" >
                  <div class="video_element"  style="margin: 0px">
                    
                      <?php foreach ($users as $user) { ?>
                        <?php if($user['id'] == $streams[1]['user_id']) { ?>
                          <video class="" id="videoPlayer2" controls muted="true" value="<?php echo $user['stream_key'] ?>" style="max-height: 50vh; max-width: 100%; padding: 0px"></video>
                          <div class="over_video">
                          <img src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" style="margin-right: 20px; border-radius: 5px;" alt="" width="80" height="80">
                          <div style="">
                            <a class="card-text good_link" style="font-size: 30px" href="<?php echo site_url('home/stream');?>?id=<?php echo $streams[1]["id"] ?>"><?php echo $streams[1]['name'] ?></a>
                            <h1 class="display-4" style="font-size: 25px"><?php echo $user['login'] ?></h1>
                          </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div style="display: flex; justify-content: center;" >
                  <div class="video_element"  style="margin: 0px">
                    
                      <?php foreach ($users as $user) { ?>
                        <?php if($user['id'] == $streams[2]['user_id']) { ?>
                          <video class="" id="videoPlayer3" controls muted="true" value="<?php echo $user['stream_key'] ?>" style="max-height: 50vh; max-width: 100%; padding: 0px"></video>
                          <div class="over_video">
                          <img src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" style="margin-right: 20px; border-radius: 5px;" alt="" width="80" height="80">
                          <div style="">
                            <a class="card-text good_link" style="font-size: 30px" href="<?php echo site_url('home/stream');?>?id=<?php echo $streams[2]["id"] ?>"><?php echo $streams[2]['name'] ?></a>
                            <h1 class="display-4" style="font-size: 25px"><?php echo $user['login'] ?></h1>
                          </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <p class="title_text"><i class="fab fa-hotjar" style="margin-right: 5px"></i>Популярное:</p>
      <div class="" style="margin-top: 20px">
        <div id="stream_list" class="row">
          <?php 
            $data['streams'] = $streams;
            $data['users'] = $users;
            $this->load->view('pages/streams/stream_item', $data); 
          ?>
        </div>
      </div>
      <p class="title_text"><i class="fas fa-th" style="margin-right: 5px"></i>Категории:</p>
      <div class="" style="margin-top: 20px">
        <div id="stream_list" class="row">
          <?php 
            $data['categories'] = $categories;
            $this->load->view('pages/streams/categories_item', $data); 
          ?>
        </div>
      </div>
      <p class="title_text"><i class="far fa-newspaper" style="margin-right: 5px"></i>Новости:</p>
      <div class="" style="margin-top: 20px">
        <div id="stream_list" class="row">
          <?php 
            $data['news'] = $another_news;
            $this->load->view('pages/news/news_items_main', $data); 
          ?>
        </div>
      </div>
  </div>

</main>

<?php
  $this->load->view('templates/footer.php');
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
</script>
<script src="<?=base_url('assets/js/dash.all.min.js')?>"></script>
<script type="text/javascript">

  var key1 = $('#videoPlayer1').attr("value");
  var key2 = $('#videoPlayer2').attr("value");
  var key3 = $('#videoPlayer3').attr("value");

  var url1 = "http://40.118.91.40/dash/"+key1+".mpd";
  var url2 = "http://40.118.91.40/dash/"+key2+".mpd";
  var url3 = "http://40.118.91.40/dash/"+key3+".mpd";
    // var url = "http://40.118.91.40/dash/"+key+".mpd";
    // var url = "http://127.0.0.1:8090/dash/"+key+".mpd";
  var player1 = dashjs.MediaPlayer().create();
  var player2 = dashjs.MediaPlayer().create();
  var player3 = dashjs.MediaPlayer().create();
  player1.initialize(document.querySelector("#videoPlayer1"), url1, true);
  player2.initialize(document.querySelector("#videoPlayer2"), url2, false);
  player3.initialize(document.querySelector("#videoPlayer3"), url3, false);
  document.getElementById("videoPlayer1").setAttribute("poster", "http://40.118.91.40/dash/"+key1+".jpg");
  document.getElementById("videoPlayer2").setAttribute("poster", "http://40.118.91.40/dash/"+key2+".jpg");
  document.getElementById("videoPlayer3").setAttribute("poster", "http://40.118.91.40/dash/"+key3+".jpg");

</script>