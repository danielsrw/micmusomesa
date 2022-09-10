	<?php
		include('inc/css.php');
		include('admin/controllers/ContactController.php');
	?>

	<title>Contact | MUSOMESA</title>
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
						<a href="contact.php">
							Contact Us
						</a>
					</p>
					<h2 class="text-white">
						Contact Us
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-page-area section-gap">
		<div class="container">
			<!-- <div class="map-wrap" style="width:100%; height: 445px;" id="map"></div> -->
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h1>Get in touch with us!!!</h1>
					<!-- Message here -->
					<?php require_once('admin/inc/message.php') ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6>Kigali, Rwanda</h6>
							<p>Kisimenti, Rukiri ||, Street 18 KG Avenue</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone"></i>
							<h6>
								<a href="tel:+250790140002">+250 790 140 002</a>
							</h6>
							<p>Mon to Fri 9am to 10 pm</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6>
								<a href="mail:info@micmusomesa.com">info@micmusomesa.com</a>
							</h6>
							<p>Send us your query anytime!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" action="" method="POST">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="name" placeholder="Enter your name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" placeholder="Enter email address">
							</div>
							<div class="form-group">
								<input type="number" class="form-control" name="phone" placeholder="Enter phone number">
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

	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>