	<?php include('inc/css.php') ?>

	<title>Terms & Conditions | MUSOMESA</title>
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
						<a href="terms-and-conditions.php">
							Terms & Conditions
						</a>
					</p>
					<h2 class="text-white">
						Terms & Conditions
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h1>Terms & Conditions</h1>
				</div>
			</div>
		</div>
	</section>
	
	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>