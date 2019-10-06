<?php if(count($news) > 0) { foreach ($news as $news_item) { ?>
	<div class="col-md-4" style="margin-bottom: 10px">
		<div class="card shadow-sm">
			<img class="card-img-top" src="<?=base_url('assets/news_img/')?><?php echo $news_item->image ?>" alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title"><?php echo $news_item->title ?></h5>
				<p class="card-text"><?php echo $news_item->description ?></p>
				<div >
					<a class="btn btn-primary btn_like" href="<?php echo site_url('admin/edit_news');?>?id=<?php echo $news_item->id ?>" role="button" title="Редактировать"style="margin-right: 10px">
						<img src="<?=base_url('assets/images/edit.png')?>" width="30" height="30" alt="edit">
					</a>
					<a id="delete_news" class="btn_del" role="button" value="<?php echo $news_item->id ?>" title="Удалить">
						<img src="<?=base_url('assets/images/del.png')?>" width="30" height="30" alt="delete">
					</a>
				</div>
			</div>
		</div>
	</div>
<?php } } ?>