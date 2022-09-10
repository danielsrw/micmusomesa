	<?php
		include('inc/css.php');
	?>

	<style>
		.learn-more {
			color: black;
			position: relative;
			display: inline-block;
			padding-bottom: 10px;
		}

		.learn-more:before {
			content: "";
			position: absolute;
			left: 0;
			width: 100%;
			bottom: 0;
			height: 2px;
			background-color: #005555;
			-webkit-transition: .3s all ease;
			-o-transition: .3s all ease;
			transition: .3s all ease;
		}

		.learn-more:hover:before {
			width: 0%;
		}
	</style>

	<title>Home | MUSOMESA</title>
</head>
<body>

	<?php include('inc/header.php') ?>

	<?php include('inc/hero.php') ?>

	<section class="property-area section-gap relative" id="property">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h1>Featured Properties</h1>
					<p>
						Who are in extremely love with eco friendly system.
					</p>
				</div>
			</div>
			<div class="row">
				<?php
			        $i=0;
			        $statement = $pdo->prepare("SELECT * FROM properties ORDER BY id DESC");
			        $statement->execute();
			        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

			        foreach ($result as $row) { $i++; ?>
					
					<?php include('inc/property.php') ?>

				<?php } ?>
			</div>
		</div>
	</section>

	<section class="features-1">
      	<div class="container">
	        <div class="row">
	        	<?php
				    $i=0;
				    $statement = $pdo->prepare("SELECT * FROM services ORDER BY id DESC LIMIT 4");
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

	<section class="about-area">
		<div class="container-fluid">
			<div class="row d-flex justify-content-end align-items-center">
				<div class="col-lg-7 about-left">
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

	<!-- <section class="city-area section-gap">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h1>Properties in Various Location</h1>
					<p>
						Who are in extremely love with eco friendly system.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 mb-10">
					<div class="content">
						<a href="#" target="_blank">
							<div class="content-overlay"></div>
							<img class="content-image img-fluid d-block mx-auto" src="assets/img/p1.jpg" alt="">
							<div class="content-details fadeIn-bottom">
								<h3 class="content-title">Musanze</h3>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 mb-10">
					<div class="content">
						<a href="#" target="_blank">
							<div class="content-overlay"></div>
							<img class="content-image img-fluid d-block mx-auto" src="assets/img/p2.jpg" alt="">
							<div class="content-details fadeIn-bottom">
								<h3 class="content-title">Nyarugenge</h3>
							</div>
						</a>
					</div>
					<div class="row city-bottom">
						<div class="col-lg-6 col-md-6 mt-30">
							<div class="content">
								<a href="#" target="_blank">
									<div class="content-overlay"></div>
									<img class="content-image img-fluid d-block mx-auto" src="assets/img/p3.jpg" alt="">
									<div class="content-details fadeIn-bottom">
										<h3 class="content-title">Kicukiro</h3>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 mt-30">
							<div class="content">
								<a href="#" target="_blank">
									<div class="content-overlay"></div>
									<img class="content-image img-fluid d-block mx-auto" src="assets/img/p4.jpg" alt="">
									<div class="content-details fadeIn-bottom">
										<h3 class="content-title">Rubavu</h3>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<!-- <section class="blog_categorie_area">
        <div style="width: 98.5%;">
            <div class="row">
            	<?php
                    $i=0;
                    $statement = $pdo->prepare("SELECT * FROM types WHERE status = 1 ORDER BY id DESC");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) { $i++; ?>
	                <div class="col-lg-2">
	                    <div class="categories_post">
	                        <img src="assets/img/p1.jpg" alt="post">
	                        <div class="categories_details">
	                            <div class="categories_text">
	                                <a href="">
	                                    <h5><?php echo $row['name'] ?></h5>
	                                </a>
	                                <div class="border_line"></div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>
            </div>
        </div>
    </section> -->

    <div class="about-area section-gap">
      	<div class="row justify-content-center footer-cta" data-aos="fade-up">
	        <div class="col-lg-7 mx-auto text-center">
	          	<h2 class="mb-4">Be a part of our growing real state agents</h2>
	          	<p>
		            <a href="account.php" target="_blank" class="btn btn-primary text-white py-3 px-4">Apply for Real Estate agent</a>
	          	</p>
	        </div>
      	</div>
    </div>

	<?php include('inc/testimony.php') ?>
	
	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>