	<?php
		include('inc/css.php');

		if(!isset($_REQUEST['id'])) {
		    header('location: index.php');
		    exit;
		} else {
			$statement = $pdo->prepare("SELECT * FROM services WHERE id=?");
		    $statement->execute(array($_REQUEST['id']));
		    $total = $statement->rowCount();
		    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
		    if( $total == 0 ) {
		        header('location: home.php');
		        exit;
		    }
		}

		foreach($result as $row) {
		    $name = $row['name'];
		    $description = $row['description'];
		}
	?>

	<style>
		.desc {
			color: black;
		}

		.desc i {
			color: black;
		}
	</style>

	<title><?php echo $name ?> | MUSOMESA</title>
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
						<a href="#">
							Services
						</a>
						<span class="lnr lnr-arrow-right"></span>
						<a href="#">
							<?php echo $name ?>
						</a>
					</p>
					<h2 class="text-white">
						<?php echo $name ?>
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-12">
					<div class="desc">
						<?php echo $description ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>