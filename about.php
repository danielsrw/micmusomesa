	<?php include('inc/css.php') ?>

	<title>About | MUSOMESA</title>
</head>
<body>

	<?php include('inc/header.php') ?>

<?php
    $i=0;
    $statement = $pdo->prepare("SELECT * FROM settings");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) { $i++; ?>
	<section class="banner-area relative" id="home" style="background: url(./admin/assets/uploads/backgrounds/<?php echo $row['defaultImage']; ?>) no-repeat center;">
<?php } ?>
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex text-center align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<p class="text-white link-nav">
						<a href="home.php">Home </a>
						<span class="lnr lnr-arrow-right"></span>
						<a href="about.php">
							About Us
						</a>
					</p>
					<h2 class="text-white">
						About Us
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="about-area bg-white">
		<div class="container">
			<div class="row d-flex justify-content-end align-items-center">
				<div class="col-lg-7">
					<div class="single-about">
						<h4>Why Choose Us</h4>
						<p>
							Musomesa investment company Limited is a real Estate incorporated company providing primary real Estate management, sells and buying of all real estate products and other related services to our customers. MIC helps individuals who need to sell or buy their properties purposely for commission fee generation.
						</p>
					</div>
					<div class="single-about">
						<h4>Our Mission</h4>
						<p>
							We’re dedicated to achieving our vision by creating an energetic, positive, results-driven work environment focused on the investment and development of long-term strategy. We measure our success by the results delivered to clients. Our ethics are built on our commitment to offer superior customer service.
						</p>
					</div>
					<div class="single-about">
						<h4>Our Vision</h4>
						<p>
							M.I.C objective is to be the leading real estate service provider nationally and internationally’ and the preferred place of employment for real estate professionals. We consistently strive to develop collaborative with our clients, based on transparency and mutual trust.
						</p>
					</div>
				</div>
				<div class="col-lg-5 about-right no-padding">
					<?php
					    $i=0;
					    $statement = $pdo->prepare("SELECT * FROM settings");
					    $statement->execute();
					    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

					    foreach ($result as $row) { $i++; ?>
						<img class="img-fluid" src="./admin/assets/uploads/backgrounds/<?php echo $row['aboutImage']; ?>" alt="">
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<section class="features-1">
      	<div class="container">
	        <div class="row">
	        	<?php
				    $i=0;
				    $statement = $pdo->prepare("SELECT * FROM services ORDER BY id DESC");
				    $statement->execute();
				    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

				    foreach ($result as $row) { $i++; ?>
		          	<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
			            <div class="box-feature">
			              	<span class="flaticon-house"></span>
			              	<h3 class="mb-3"><?php echo $row['name'] ?></h3>
			              	<p>
				                Buying a new house is a thrilling event, whether it’s your...
			              	</p>
			              	<p><a href="service-show.php?id=<?php echo $row['id'] ?>" class="learn-more">Learn More</a></p>
			            </div>
		          	</div>
		          <?php } ?>
	        </div>
      	</div>
    </section>

	<section class="testomial-area">
		<div class="container">
			<h3 class="text-center">Feedback from our clients</h3>
			<div class="row">
				<?php include('inc/testimony.php') ?>
			</div>
		</div>
	</section>

	<section class="team-area" id="team">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h3>Our Team</h3>
				</div>
			</div>
			<?php include('inc/team.php') ?>
		</div>
	</section>
	
	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>