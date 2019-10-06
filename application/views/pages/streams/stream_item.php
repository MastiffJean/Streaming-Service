<?php if(count($streams) > 0) { foreach ($streams as $stream_item) { ?>
	<div class="col-md-3" style="margin-bottom: 10px">
		<div class="card shadow-sm">
			<?php foreach ($users as $user) { ?>
	            <?php if($user['id'] == $stream_item['user_id']) { ?>
	            	<img class="card-img-top" src="http://40.118.91.40/dash/<?php echo $user["stream_key"] ?>.jpg" alt="Card image cap" >
	            	<div class="card-body" style="display: flex; justify-content: space-between;">
	            		<div>
	            			<a href="<?php echo site_url('home/stream');?>?id=<?php echo $stream_item["id"] ?>" >
								<h5 class="card-title"><?php echo $stream_item["name"] ?></h5>
							</a>
							<h2 class="display-4" style="font-size: 20px"><?php echo $user["login"] ?></h2>
	            		</div>
	            		<div>
	            			<h2 class="display-4" style="font-size: 20px"><i class="far fa-heart" style="margin-right: 5px"></i><?php echo $stream_item["count"] ?></h2>
	            		</div>
						
					</div>
	            <?php } ?>
          	<?php } ?>
			
		</div>
	</div>
<?php } } ?>