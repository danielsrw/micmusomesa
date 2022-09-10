	<?php
		include('inc/css.php');
		require_once('admin/controllers/TestimonyCOntroller.php')
	?>

	<title>Testimony | MUSOMESA</title>
</head>
<body>

	<?php include('inc/header.php') ?>

<?php
    $i=0;
    $statement = $pdo->prepare("SELECT * FROM settings");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) { $i++; ?>
	<section class="banner-area relative" id="home" style="background: url(./admin/assets/uploads/backgrounds/<?php echo $row['defaultImage']; ?>) no-repeat center">
<?php } ?>
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex text-center align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<p class="text-white link-nav">
						<a href="home.php">Home </a>
						<span class="lnr lnr-arrow-right"></span>
						<a href="join-us.php">
							Testimony
						</a>
					</p>
					<h2 class="text-white">
						Testimony
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<section class="testomial-area">
						<div class="container">
							<div class="row d-flex justify-content-center">
								<div class="col-md-10 header-text">
									<h1>Feedback from our clients</h1>
									<p>
										<?php require_once('admin/inc/message.php') ?>
									</p>
								</div>
							</div>
							<div class="row">
								<?php include('inc/testimony.php') ?>
							</div>
						</div>
					</section>

					<section class="contact-page-area section-gap">
						<div class="container">
							<h3 class="mb-5">Give us your feedback</h3>
							<div class="row">
								<div class="col-lg-12">
									<form class="row contact_form" action="" method="POST">
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" name="name" placeholder="Enter your name">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="title" placeholder="Enter email address">
											</div>
											<div class="form-group">
												<select class="form-control" name="gender">
													<option>Choose your gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<textarea class="form-control" name="message" rows="1" placeholder="Enter Message"></textarea>
											</div>
										</div>
										<div class="col-md-12 text-right">
											<button type="submit" name="submit" class="btn primary-btn">
												Send Message
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
	
	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>