<style>
	.thumb_agent_img img {
		width: 30px;
		border-radius: 50%;
	}

	.thumb_agent_img span {
		color: black;
		font-size: 13px;
		font-weight: 600;
	}

	.thumb_phone {
		margin-top: 5px;
		color: black;
		font-size: 13px;
		font-weight: 600;
	}
</style>

<div class="col-lg-4">
	<div class="single-property">
		<a href="property-show.php?id=<?php echo $row['id'] ?>">
			<div class="images">
				<img class="img-fluid mx-auto d-block" src="./admin/assets/uploads/properties/<?php echo $row['featured_photo']; ?>" alt="">
				<span><?php echo $row['status'] ?></span>
			</div>
		</a>

		<div class="desc">
			<a href="property-show.php?id=<?php echo $row['id'] ?>">
				<div class="top d-flex justify-content-between">
					<h4>
						<?php echo $row['code'] ?>00<?php echo $row['id'] ?> <?php echo $row['name'] ?>
					</h4>
					<h4><?php echo number_format($row['price']) ?> RWF</h4>
				</div>
			</a>
			<div class="middle">
				<div class="d-flex justify-content-start">
					<p>
						<span class="icon-bed me-2"></span>
						<span>Bed: <?php echo $row['bedroom'] ?></span>
					</p>
					<p>
						<span class="icon-bath me-2"></span>
						Bath: <?php echo $row['bathroom'] ?>
					</p>
					<p>
						<!-- <span class="icon-tachometer"></span> -->
						Area: <?php echo $row['area'] ?> sqm
					</p>
				</div>
			</div>
		</div>
	</div>
</div>