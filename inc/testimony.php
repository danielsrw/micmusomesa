<div class="active-testimonial-carusel">
	<?php
        $i=0;
        $statement = $pdo->prepare("SELECT * FROM testimonies WHERE status=1 ORDER BY id DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) { $i++; ?>
		<div class="single-testimonial item">
			<h4>
				<?php echo $row['name'] ?>
			</h4>
			<!-- <?php if ($row['gender'] == "Male"): ?>
				<img class="mx-auto img-fluid rounded-circle" src="./assets/img/agents/man.png">
			<?php else: ?>
				<img class="mx-auto img-fluid rounded-circle" src="./assets/img/agents/woman.png">
			<?php endif ?>
			<h4>
				<?php echo $row['name'] ?>
			</h4> -->
			<p class="desc">
				<?php echo $row['message'] ?>
			</p>
			<p>
				<?php echo $row['title'] ?>
			</p>
		</div>
	<?php } ?>
</div>