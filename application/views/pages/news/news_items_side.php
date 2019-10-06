<?php if(count($news) > 0) { foreach ($news as $news_item) { ?>
	<div class="col-md-12" style="margin-bottom: 10px">
		<div class="card shadow-sm">
			<img class="card-img-top" src="<?=base_url('assets/news_img/')?><?php echo $news_item['image'] ?>" alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title"><?php echo $news_item['title'] ?></h5>
				<a href="<?php echo site_url('home/news_details');?>?id=<?php echo $news_item['id'] ?>" class="btn btn-info">Подробнее &raquo;</a>
			</div>
		</div>
	</div>
<?php } } ?>
