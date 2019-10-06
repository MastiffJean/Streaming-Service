<?php if(count($categories) > 0) { foreach ($categories as $category_item) { ?>
	<div class="col-md-2" style="margin-bottom: 10px">
		<div class="card shadow-sm">
			<img class="card-img-top" src="<?=base_url('assets/category_img/')?><?php echo $category_item["image"] ?>" alt="Card image cap">
	        <div class="card-body">
				<a href="<?php echo site_url('home/streams_category');?>?category_id=<?php echo $category_item["id"] ?>" >
					<h5 class="card-title"><?php echo $category_item["name"] ?></h5>
				</a>
			</div>
		</div>
	</div>
<?php } } ?>