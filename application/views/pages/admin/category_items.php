<?php foreach ($categories as $category_item) { ?>
	<div class="col-12" style="margin-bottom: -20px">
		<div class="card shadow-sm">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title"><?php echo $category_item->name ?></h5>
					</div>
					<div class="col text-right">
						<a class="btn btn-primary btn_like" href="<?php echo site_url('admin/edit_category');?>?id=<?php echo $category_item->id ?>" role="button" title="Редактировать"style="margin-right: 10px">
				            <img src="<?=base_url('assets/images/edit.png')?>" width="30" height="30" alt="edit">
				        </a>
						<a id="delete_category_item" class="btn_del" value="<?php echo $category_item->id ?>" title="Удалить категорию">
							<img src="<?=base_url('assets/images/del.png')?>" width="30" height="30" alt="delete">
						</a>
					</div>
				</div>      
			</div>
		</div>
	</div>
<?php } ?>