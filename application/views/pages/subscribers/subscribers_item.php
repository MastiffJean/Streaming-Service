<?php if(count($streams) > 0) { foreach ($streams as $stream) { ?>
  <div class="col-md-2" style="margin-bottom: 10px">
    <div class="card shadow-sm">
      <?php foreach ($users as $user) { ?>
        <?php if($user['id'] == $stream['user_id']) { ?>
          <img class="card-img-top" src="<?=base_url('assets/user_img/')?><?php echo $user['image'] ?>" alt="Card image cap">
          <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
              <div>
                <a href="<?php echo site_url('home/stream');?>?id=<?php echo $stream['id'] ?>" >
                  <h5 class="card-title"><?php echo $user["login"] ?></h5>
                </a>
                <?php if($stream['status_id'] == 2) { ?>
                  <h5 class="card-title" style="color: red">LIVE</h5>
                <?php } ?>
              </div>
              <div class="text-right">
                <a id="delete_sub_item" class="btn_del" role="button" value="<?php echo $stream['id'] ?>" title="Удалить из списка отслеживаемого">
                  <img src="<?=base_url('assets/images/del.png')?>" width="30" height="30" alt="Список желаний">
                </a>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
<?php } } ?>