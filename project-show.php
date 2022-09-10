	<?php
		include('inc/css.php');

		if(!isset($_REQUEST['id'])) {
		    header('location: index.php');
		    exit;
		} else {
			$statement = $pdo->prepare("SELECT * FROM projects WHERE id=?");
		    $statement->execute(array($_REQUEST['id']));
		    $total = $statement->rowCount();
		    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
		    if( $total == 0 ) {
		        header('location: finished-project.php');
		        exit;
		    }
		}

		foreach($result as $row) {
		    $name = $row['name'];
		    $image = $row['image'];
		    $views = $row['views'];
		    $category = $row['category'];
		    $created_at = $row['created_at'];
		    $description = $row['description'];
		}

		$views = $views + 1;

		$statement = $pdo->prepare("UPDATE projects SET views=? WHERE id=?");
		$statement->execute(array($views,$_REQUEST['id']));
	?>

	<title>Property Show | MUSOMESA</title>
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
						<a href="properties.php">Property Show </a>
					</p>
					<h2 class="text-white">
						<?php echo $name ?>
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="blog_area single-post-area p_120">
        <div class="container">
            <div class="row mt-80">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="./admin/assets/uploads/projects/<?php echo $image; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a class="active" href="#"><?php echo $category ?></a>
                                </div>
                                <ul class="blog_meta list">
                                    <li>
                                        <a href="#"><?php echo $views ?> Views
                                            <i class="lnr lnr-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">06 Comments
                                            <i class="lnr lnr-bubble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2><?php echo $name ?></h2>
                            <p class="excert">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <p>
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <div class="quotes">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-25">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('inc/sidebar.php') ?>
            </div>
        </div>
    </section>

	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>