	<?php
		include('inc/css.php');

		if(!isset($_REQUEST['s__status'], $_REQUEST['s__location'], $_REQUEST['s__property_type'], $_REQUEST['s__price'])) {
		    header('location: index.php');
		    exit;
		} else {
			if($_REQUEST['s__status'], $_REQUEST['s__location'], $_REQUEST['s__property_type'], $_REQUEST['s__price'] == '') {
				header('location: index.php');
		    	exit;
			}
		}
	?>

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

	<title>Search Result | MUSOMESA</title>
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
						<a href="properties.php">Property Search</a>
					</p>
					<h2 class="text-white">
						Property Search
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="property-area section-gap relative" id="property">
		<div class="container">
			<p>
				Search Result: 
				<i>
					<?php 
		                $s__status = strip_tags($_REQUEST['s__status']); 
		                echo $s__status; 
		            ?> 
				</i>
			</p>

			<div class="row">
				<?php
					$adjacents = 5;
		            $statement = $pdo->prepare("SELECT * FROM properties WHERE status=? AND district LIKE ? AND type=? AND price=?");
		            $statement->execute(array(1, $s__status));
		            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result as $row) { $i++; ?>
					<div class="col-lg-4">
						<div class="single-property">
							<div class="images">
								<img class="img-fluid mx-auto d-block" src="assets/img/s1.jpg" alt="">
								<span>For Sale</span>
							</div>

							<div class="desc">
								<div class="top d-flex justify-content-between">
									<h4><a href="#">04 Bed Duplex</a></h4>
									<h4>$3.5M</h4>
								</div>
								<div class="middle">
									<div class="d-flex justify-content-start">
										<p>Bed: 04</p>
										<p>Bath: 03</p>
										<p>Area: 7sqm</p>
									</div>
									<div class="d-flex justify-content-start">
										<p>Pool: <span class="gr">Yes</span></p>
										<p>WiFi: <span class="rd">No</span></p>
										<p>Washer: <span class="rd">No</span></p>
									</div>
								</div>
								<div class="bottom d-flex justify-content-start">
									<p><span class="lnr lnr-heart"></span> 15 Likes</p>
									<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>