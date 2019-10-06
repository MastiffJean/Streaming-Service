<!-- <?php if(count($users) > 0) { foreach ($users as $user) { ?>
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col" style="display: flex;">
            <div class="d-flex justify-content-center align-items-center" style="width: 100px; height: 100px;">
              <img src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" style="max-width: 100px; max-height: 100px;">
            </div>
            <div style="margin-left: 20px">
              <?php foreach ($streams as $stream) { ?>
                <?php if($user['id'] == $stream['user_id']) { ?>    
                  <a class="card-title good_link" href="<?php echo site_url('home/stream');?>?id=<?php echo $stream['id'] ?>"><?php echo $user['login'] ?></a>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>      
      </div>
    </div>
  </div>
<?php } } ?> -->

<?php if(count($users) > 0) { foreach ($users as $user) { ?>
  <div class="col-md-2" style="margin-bottom: 10px">
    <div class="card shadow-sm">
      <?php foreach ($streams as $stream) { ?>
        <?php if($user['id'] == $stream['user_id']) { ?>
          <img class="card-img-top" src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" alt="Card image cap">
          <div class="card-body">
            <div>
              <a href="<?php echo site_url('home/stream');?>?id=<?php echo $stream['id'] ?>" >
                <h5 class="card-title"><?php echo $user["login"] ?></h5>
              </a>
              <?php if($stream['status_id'] == 2) { ?>
                  <h5 class="card-title" style="color: red">LIVE</h5>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
<?php } } ?>