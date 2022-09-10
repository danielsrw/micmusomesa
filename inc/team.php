<div class="row d-flex align-items-center">
	<?php
        $i=0;
        $statement = $pdo->prepare("SELECT * FROM teams WHERE status=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) { $i++; ?>
		<div class="col-lg-3 col-md-4 single-team">
			<div class="thumb">
				<img class="img-fluid" src="./admin/assets/uploads/team/<?php echo $row['image']; ?>" alt="">
			</div>
			<div class="meta-text">
				<h5 style="font-size: 14px;" class="mb-2">
					<?php echo $row['name']; ?>
				</h5>
				<p style="font-size: 13px; font-weight: 500;" class="mb-2">
					<?php echo $row['position']; ?>
				</p>
				<p style="font-size: 13px;" class="mb-2">
	                <?php if ($row['phone'] == null): ?>
                        <i class="fa fa-phone"></i>
						<a href="tel:+250790140002" style="color: black;">
							+250 790 140 002
						</a>
                    <?php else: ?>
                        <i class="fa fa-phone"></i>
						<a href="tel:<?php echo $row['phone']; ?>" style="color: black;">
							+<?php echo $row['phone']; ?>
						</a>
                    <?php endif ?>
				</p>
				<p style="font-size: 13px;">
	                <?php if ($row['email'] == null): ?>
                        <i class="fa fa-reply"></i>
						<a href="mail:info@micmusomesa.com" style="color: black;">
							info@micmusomesa.com
						</a>
                    <?php else: ?>
                        <i class="fa fa-reply"></i>
						<a href="mail:<?php echo $row['email']; ?>" style="color: black;">
							<?php echo $row['email']; ?>
						</a>
                    <?php endif ?>
				</p>
			</div>
		</div>
	<?php } ?>
</div>