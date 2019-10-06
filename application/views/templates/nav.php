<?php
  $user = 'гость';
  if($this->session->has_userdata('user')) {
    $user = $this->session->userdata('user');
  }

?>
<style>
  #search_form .search_text{
    background-color: #444d57;
    border-color: #444d57;
    transition: 0.2s;
    color: #fafafa;
  }
  #search_form .search_text:hover {
    background-color: #fafafa;
    color: #444d57;
  }
  #search_form .search_text:focus {
    background-color: #fafafa;
    color: #444d57;
  }
  #search_form .search_button{
    background-color: #346ca3;
    border-color: #346ca3;
    transition: 0.2s;
  }
  #search_form .search_button:hover {
    background-color: #3a82c9;
    border-color: #3a82c9;
  }
  #nav_logo:hover{
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
    transition: all 0.8s ease-in-out 0s;
  }
  #nav_user_image{
    border-radius: 5px;
  }
</style>
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="<?=site_url('home/index')?>">
      <img id="nav_logo" src="<?=base_url('assets/images/favicon.ico')?>" width="30" height="30" class="d-inline-block align-top" alt="">
      Streams GO
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav " style="margin-right: 20px">
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('home/streams')?>">Просмотр</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('home/categories')?>">Категории</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('home/news')?>">Новости</a>
        </li>
        <?php if ($user == 'admin') { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('admin/admin')?>">Управление</a>
          </li>
        <?php } ?>
      </ul>
      
      <form id="search_form" class="form-inline input-group mr-auto" action="<?php echo site_url('home/search_keyword');?>" method = "post" style="max-width: 500px">
        <input type="text" name="keyword" class="form-control search_text" placeholder="" aria-label="Search" aria-describedby="button-addon2">
        <div class="input-group-append">
          <input class="btn btn-primary search_button" value="Поиск" type="submit" id="button-addon2"></input>
        </div>
      </form>
      <ul class="navbar-nav navbar-right" style="margin-left: 20px; margin-top: 10px">
      </ul>
      <ul class="navbar-nav navbar-right">
        <?php if ($user == 'гость') { ?>
          <li class="nav-item"><a class="nav-link" href="<?=site_url('account/entry')?>">Вход</a></li>
          <li class="nav-item"><a class="nav-link" href="<?=site_url('account/reg')?>">Регистрация</a></li>
        <?php } else { ?>
          
          <li class="nav-item dropdown" style="margin-right: 10px;">
            <a class="nav-link dropdown" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px">
              <div style="display: flex; align-items: center;">
                <img id="nav_user_image" src="<?=base_url('assets/user_img/')?><?php echo $user_info['image'] ?>" alt="" style="width: 40px; height: 40px;">
                <div style="margin-left: 15px; margin-right: 15px"><?=$user?></div>
                <i class="fas fa-angle-down" style="margin-right: 10px"></i>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?=site_url('account/profile')?>">Профиль</a>
              <a class="dropdown-item" href="<?=site_url('home/subscribers')?>">Отслеживаемое</a>
              <a class="dropdown-item" href="<?=site_url('account/stream_settings')?>">Панель управления</a>
              <a class="dropdown-item" href="<?=site_url('account/settings')?>">Настройки</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?=site_url('account/exits')?>">Выход</a>
            </div>
          </li>
          <li class="nav-item nav_img" style="margin-right: 15px;" title="Подписки">
            <a href="<?=site_url('home/subscribers')?>">
              <img src="<?=base_url('assets/images/like.png')?>" width="40" height="40" alt="Список желаний">
            </a>
          </li>
          <li class="nav-item nav_img" style="" title="Выход">
            <a href="<?=site_url('account/exits')?>">
              <img src="<?=base_url('assets/images/exit.png')?>" width="40" height="40" alt="Выход">
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
</header>