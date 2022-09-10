	<?php
		include('inc/css.php');

		if(!isset($_REQUEST['id'])) {
		    header('location: index.php');
		    exit;
		} else {
			$statement = $pdo->prepare("SELECT * FROM properties WHERE id=?");
		    $statement->execute(array($_REQUEST['id']));
		    $total = $statement->rowCount();
		    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
		    if( $total == 0 ) {
		        header('location: home.php');
		        exit;
		    }
		}

		foreach($result as $row) {
		    $id = $row['id'];
		    $code = $row['code'];
		    $name = $row['name'];
		    $district = $row['district'];
            $status = $row['status'];
            $room = $row['room'];
            $bedroom = $row['bedroom'];
            $bathroom = $row['bathroom'];
            $price = $row['price'];
            $year = $row['year'];
            $area = $row['area'];
            $views = $row['views'];
            $address = $row['address'];
            $description = $row['description'];
            $featured_photo = $row['featured_photo'];
		}

		$views = $views + 1;

		$statement = $pdo->prepare("UPDATE properties SET views=? WHERE id=?");
		$statement->execute(array($views,$_REQUEST['id']));

		$statement = $pdo->prepare("SELECT * FROM property_features WHERE property_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
		foreach ($result as $row) {
		    $feature[] = $row['feature_id'];
		}

		$statement = $pdo->prepare("SELECT * FROM property_types WHERE property_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
		foreach ($result as $row) {
		    $type[] = $row['type_id'];
		}

		$statement = $pdo->prepare("SELECT * FROM property_agent WHERE property_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
		foreach ($result as $row) {
		    $agent[] = $row['agent_id'];
		}
	?>

	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="./assets/css/property.css">

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <style>
		.swiper-slide {
		   display: flex;
		   align-items: center;
		   justify-content: center;
		}


		.mySwiper2 {
		   width: 100%;
		   height: auto;
		}


		.mySwiper {
		   height: 5%;
		   box-sizing: border-box;
		   margin: 10px;
		}


		.mySwiper .swiper-slide {
		   opacity: 0.4;
		}


		.swiper-slide {
		   background-position: center;
		}


		.mySwiper .swiper-slide-thumb-active {
		   opacity: 1;
		}
	</style>

	<title>For <?php echo $status ?> | Real Estate in Rwanda M.I.C</title>
</head>
<body>

	<?php include('inc/header.php') ?>

<!-- <?php
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
						<a href="#">Property</a>
					</p>
					<h2 class="text-white">
						<?php echo $code ?>00<?php echo $id ?> <?php echo $name ?>
					</h2>
				</div>
			</div>
		</div>
	</section> -->

    <section class="blog_area section-gap">
        <div class="container">
            <div class="row">
            	<div class="col-lg-8 mt-4">
            		<!-- <img src="./admin/assets/uploads/properties/<?php echo $featured_photo; ?>" class="img-fluid mb-4"> -->
            		<div class="swiper mySwiper2">
			           <div class="swiper-wrapper">
			               	<div class="swiper-slide slide_1">
			               		<img src="./admin/assets/uploads/properties/<?php echo $featured_photo; ?>" class="img-fluid">
			               	</div>
		            		<?php
		                        $statement = $pdo->prepare("SELECT * FROM property_photos WHERE property_id=?");
		                        $statement->execute(array($_REQUEST['id']));
		                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
		                        foreach ($result as $row) { ?>
		                        	<div class="swiper-slide slide_2">
					               		<img src="./admin/assets/uploads/property_photos/<?php echo $row['photo']; ?>" class="img-fluid">
					               	</div>
		                    <?php } ?>
			           	</div>
			           	<div class="swiper-button-next"></div>
			           	<div class="swiper-button-prev"></div>
			       	</div>

			       	<div thumbsSlider="" class="swiper mySwiper">
			           	<div class="swiper-wrapper">
			               	<div class="swiper-slide slide_1">
			               		<img src="./admin/assets/uploads/properties/<?php echo $featured_photo; ?>" class="img-fluid">
			               	</div>
			               	<?php
                                $i=1;
                                $statement = $pdo->prepare("SELECT * FROM property_photos WHERE property_id=?");
                                $statement->execute(array($_REQUEST['id']));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) { ?>
				               	<div class="swiper-slide slide_2">
				               		<img src="./admin/assets/uploads/property_photos/<?php echo $row['photo']; ?>" class="img-fluid">
				               	</div>
			               	<?php $i++; } ?>
			           	</div>
			       	</div>
            		<div class="pd-text">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="pd-title">
                                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                    <div class="label">For <?php echo $status ?></div>
                                    <div class="pt-price"><?php echo number_format($price) ?> RWF</div>
                                    <h3>
                                    	<?php echo $code ?>00<?php echo $id ?> <?php echo $name ?>
                                    </h3>
                                    <p><span class="icon_pin_alt"></span> 3 Middle Winchendon Rd, Rindge, NH 03463</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="pd-social">
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
										<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
										<a class="a2a_button_facebook"></a>
										<a class="a2a_button_twitter"></a>
										<a class="a2a_button_email"></a>
										<a class="a2a_button_telegram"></a>
										<a class="a2a_button_google_gmail"></a>
										<a class="a2a_button_outlook_com"></a>
										<a class="a2a_button_whatsapp"></a>
									</div>
									<script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                        </div>
                        <div class="pd-board">
                            <div class="tab-board">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Features</a>
                                    </li>
                                </ul><!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="tab-details">
                                            <ul class="left-table">
                                                <li>
                                                    <span class="type-name">Property Type</span>
                                                    <span class="type-value">
                                                    	<?php if(isset($type)): ?>
							            					<?php
							                                    $statement = $pdo->prepare("SELECT * FROM types");
							                                    $statement->execute();
							                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
							                                    foreach ($result as $row) {
								                                if(in_array($row['id'], $type)) { ?>
		                                                    		<?php echo $row['name']; ?>
									                        <?php } } ?>
							                            <?php endif; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Property ID</span>
                                                    <span class="type-value">
                                                    	#<?php echo $id ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Price</span>
                                                    <span class="type-value">
                                                    	<?php echo number_format($price) ?> RWF
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Year Built</span>
                                                    <span class="type-value">
                                                    	<?php if ($row['status'] == 1): ?>
                                                            <?php echo $year ?>
                                                        <?php else: ?>
                                                            N/A
                                                        <?php endif ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Contract type</span>
                                                    <span class="type-value">
                                                    	<?php echo $status ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Agent</span>
                                                    <span class="type-value">
                                                    	<?php if(isset($agent)): ?>
							            					<?php
							                                    $statement = $pdo->prepare("SELECT * FROM agents");
							                                    $statement->execute();
							                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
							                                    foreach ($result as $row) {
								                                if(in_array($row['id'], $agent)) { ?>
								                                	<?php echo $row['name']; ?>
								                            <?php } } ?>
                            							<?php endif; ?>
                                                    </span>
                                                </li>
                                            </ul>
                                            <ul class="right-table">
                                                <li>
                                                    <span class="type-name">Home Area</span>
                                                    <span class="type-value">
                                                    	<?php echo $area ?> sqm
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Rooms</span>
                                                    <span class="type-value">
                                                    	<?php echo $room ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Bedrooms</span>
                                                    <span class="type-value">
                                                    	<?php echo $bedroom ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Bathrooms</span>
                                                    <span class="type-value">
                                                    	<?php echo $bathroom ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Garages</span>
                                                    <span class="type-value">
                                                    	N/A
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="type-name">Parking lots</span>
                                                    <span class="type-value">
                                                    	N/A
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                                        <div class="tab-desc">
                                            <p>
                                            	<?php echo $description ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                                        <div class="tab-details">
                                            <ul class="right-table">
                                            	<?php if(isset($feature)): ?>
									    			<?php
			                                            $statement = $pdo->prepare("SELECT * FROM features");
			                                            $statement->execute();
			                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
			                                            foreach ($result as $row) {
			                                            if(in_array($row['id'], $feature)) { ?>
			                                                <li>
			                                                    <span class="type-name">
			                                                    	<?php echo $row['name']; ?>
			                                                    </span>
			                                                </li>
	                                                <?php } } ?>
									    		<?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
            	<div class="col-lg-4 mt-4">
            		<div class="blog_right_sidebar">
            			<aside class="single_sidebar_widget author_widget">
            				<?php if(isset($agent)): ?>
            					<?php
                                    $statement = $pdo->prepare("SELECT * FROM agents");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
	                                if(in_array($row['id'], $agent)) { ?>
			                            <img class="author_img rounded-circle img-fluid w-25" src="assets/img/agents/a1.png" alt="">
			                            <h4>
			                            	<?php echo $row['name']; ?>
			                            </h4>
		                            	<span>
		                            		<?php echo $row['email'] ?>
		                            	</span>
		                        <?php } } ?>
                            <?php endif; ?>
                            <form class="row contact_form mt-2" action="" method="POST">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" name="name" placeholder="Enter your name">
									</div>
									<div class="form-group">
										<input type="email" class="form-control" name="email" placeholder="Enter your email address">
									</div>
									<div class="form-group">
										<textarea class="form-control" rows="5" name="message" placeholder="Enter you message here..."></textarea>
									</div>
								</div>
								<div class="col-md-12 text-right">
									<button type="submit" name="submit" class="btn primary-btn">
										Send Message
									</button>
								</div>
							</form>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                        	<h3 class="widget_title mb-3">Calculate Mortgage</h3>
                        	<?php include('inc/mortgage.php') ?>
                        </aside>
            		</div>
            	</div>
            </div>
        </div>
    </section>

    <section class="property-area section-gap relative" id="property">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h1>Similar Properties</h1>
				</div>
			</div>
			<div class="row">
				<?php
			        $i=0;
			        $statement = $pdo->prepare("SELECT * FROM properties WHERE district = $district ORDER BY id DESC");
			        $statement->execute();
			        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

			        foreach ($result as $row) { $i++; ?>
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
											<?php echo $row['name'] ?>
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
				<?php } ?>
			</div>
		</div>
	</section>

	<?php include('inc/footer.php') ?>

	<script type="text/javascript">
 		//  Initialize Swiper
		let swiper = new Swiper(".mySwiper", {
		 spaceBetween: 10,
		 slidesPerView: 4,
		 freeMode: true,
		 watchSlidesProgress: true,
		});


		let swiper2 = new Swiper(".mySwiper2", {
		 spaceBetween: 10,
		 navigation: {
		   nextEl: ".swiper-button-next",
		   prevEl: ".swiper-button-prev",
		 },
		 thumbs: {
		   swiper: swiper,
		 },
		});
 	</script>

	<?php include('inc/js.php') ?>