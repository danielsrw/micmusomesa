	<?php
		include('inc/css.php');
		include('admin/controllers/AgentsController.php');

		if(!isset($_SESSION['customer'])) {
		    header('location: '.BASE_URL.'logout.php');
		    exit;
		} else {
		    // If customer is logged in, but admin make him inactive, then force logout this user.
		    $statement = $pdo->prepare("SELECT * FROM agents WHERE id=? AND status=?");
		    $statement->execute(array($_SESSION['customer']['id'], 0));
		    $total = $statement->rowCount();
		    if($total) {
		        header('location: '.BASE_URL.'logout.php');
		        exit;
		    }
		}
	?>

	<style>
		.author_img {
			width: 120px;
			height: 120px;
		}
		.c__search {
			padding: 30px;
		}

		.c__search .search_widget .input-group .form-control {
			font-size: 12px;
			line-height: 29px;
			border: 0px;
			width: 100%;
			font-weight: 300;
			color: #222;
			padding: 0 40px 0 20px;
			border-radius: 45px;
			z-index: 0;
			background: #eee;
		}

		.c__search .search_widget .input-group .form-control:focus {
			box-shadow: none;
		}

		.c__search .search_widget .input-group .btn-default {
			position: absolute;
			right: 20px;
			background: transparent;
			border: 0px;
			box-shadow: none;
			font-size: 14px;
			color: #fff;
			padding: 0px;
			top: 50%;
			transform: translateY(-50%);
			z-index: 1;
		}

		.c__search .search_widget .input-group .btn-default i {
			color: #222;
		}

		.form-group {
	        margin-bottom: 40px;
	    }

	    .form-control {
	        border-radius: 0;
	        border: 1px solid #444;
	        font-size: 14px;
	    }

	    .c_label_checkbox {
	        color: #444;
	        font-size: 14px;
	        font-weight: 600;
	    }

	    .btn {
	        border-radius: 0;
	    }
	</style>

	<title>Agent Show | MUSOMESA</title>
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
						<a href="agents.php">
							Agents
						</a>
					</p>
					<h2 class="text-white">
						Agents
					</h2>
				</div>
			</div>
		</div>
	</section>
	
	<section class="whole-wrap pb-5">
		<div class="container">
			<div class="section-top-border">
				<div class="row">
					<?php include('./admin/inc/message.php') ?>
				</div>
				<div class="row">
					<div class="col-md-12 pills">
						<div class="bd-example bd-example-tabs">
	                        <div class="d-flex mb-3">
	                            <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
	                                <li class="nav-item">
	                                    <a class="nav-link btn-sm active" id="agent-dashboard-tab" data-toggle="pill" href="#agent-dashboard" role="tab" aria-controls="agent-dashboard" aria-expanded="true">Dashboard</a>
	                                </li>
	                                <li class="nav-item">
	                                    <a class="nav-link btn-sm" id="update-agent-profile-tab" data-toggle="pill" href="#update-agent-profile" role="tab" aria-controls="update-agent-profile" aria-expanded="true">Update Profile</a>
	                                </li>
	                                <li class="nav-item">
	                                    <a class="nav-link btn-sm" id="update-agent-profile-image-tab" data-toggle="pill" href="#update-agent-profile-image" role="tab" aria-controls="update-agent-profile-image" aria-expanded="true">Update Profile Image</a>
	                                </li>
	                                <li class="nav-item">
	                                    <a class="nav-link btn-sm" id="update-agent-password-tab" data-toggle="pill" href="#update-agent-password" role="tab" aria-controls="update-agent-password" aria-expanded="true">Update Password</a>
	                                </li>
	                                <li class="nav-item">
	                                    <a class="nav-link btn-sm" id="agent-properties-tab" data-toggle="pill" href="#agent-properties" role="tab" aria-controls="agent-properties" aria-expanded="true">Properties</a>
	                                </li>
	                                <li class="nav-item">
	                                    <a class="nav-link btn-sm" id="agent-add-property-tab" data-toggle="pill" href="#agent-add-property" role="tab" aria-controls="agent-add-property" aria-expanded="true">Add Property</a>
	                                </li>
	                            </ul>
	                        </div>
	                        <div class="tab-content col-md-12 mb-3" id="pills-tabContent">
	                            <div class="tab-pane fade show active" id="agent-dashboard" role="tabpanel" aria-labelledby="agent-dashboard-tab">
	                                <div class="row">
										<div class="col-md-4">
											<div class="single-defination">
												<div class="d-flex justify-content-between">
													<img class="author_img rounded-circle" src="./admin/assets/uploads/agents/<?php echo $_SESSION['customer']['image']; ?>" alt="">
													<div>
														<h5 style="padding: 10px 0 0 0" class="mb-3">
															<?php echo $_SESSION['customer']['name']; ?>
														</h5>
														<span><b><?php echo $_SESSION['customer']['address']; ?></b></span>
														<p class="mt-3">Since 2020</p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="single-defination" style="padding: 10px 30px;">
												<div class="d-flex justify-content-between">
													<p>Property:</p>
													<span>20</span>
												</div>
												<div class="d-flex justify-content-between">
													<p>Email:</p>
													<span><?php echo $_SESSION['customer']['email']; ?></span>
												</div>
												<div class="d-flex justify-content-between">
													<p>Phone:</p>
													<span><?php echo $_SESSION['customer']['phone']; ?></span>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="single-defination">
												<div class="c__search">
													<div class="single_sidebar_widget search_widget">
														<h5 class="mb-3">Send Message to <?php echo $_SESSION['customer']['name'] ?></h5>
							                            <div class="input-group">
							                                <input type="text" class="form-control" placeholder="Message">
							                                <span class="input-group-btn">
							                                    <form>
							                                    	<button type="submit" class="btn btn-default" type="button">
								                                        <i class="fa fa-paper-plane"></i>
								                                    </button>
							                                    </form>
							                                </span>
							                            </div>
							                        </div>
						                        </div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="row">
												<p>
													<?php echo $_SESSION['customer']['description']; ?>
												</p>
											</div>
										</div>
									</div>
	                            </div>
	                            <div class="tab-pane fade show" id="update-agent-profile" role="tabpanel" aria-labelledby="update-agent-profile-tab">
	                                <h5 class="mb-3">Update Agent Profile</h5>
	                                <form method="POST" action="">
	                                	<?php $csrf->echoInputField(); ?>
					                    <div class="form-group d-flex">
					                        <input type="text" class="form-control mr-1" name="name" value="<?php echo $_SESSION['customer']['name']; ?>">
					                        <input type="text" class="form-control ml-1" name="email" value="<?php echo $_SESSION['customer']['email']; ?>">
					                    </div>
					                    <div class="form-group d-flex">
					                        <input type="text" class="form-control mr-1" name="phone" value="<?php echo $_SESSION['customer']['phone']; ?>">
					                        <input type="text" class="form-control mr-1" name="address" value="<?php echo $_SESSION['customer']['address']; ?>">
					                    </div>
					                    <div class="form-group d-flex">
					                        <textarea class="form-control" rows="5" name="description" placeholder="Description"><?php echo $_SESSION['customer']['description']; ?></textarea>
					                    </div>
					                    <div class="form-group">
					                        <button class="btn btn-sm btn-primary" name="update-agent-profile">
					                        	Update Profile
					                        </button>
					                    </div>
					                </form>
	                            </div>
	                            <div class="tab-pane fade show" id="update-agent-profile-image" role="tabpanel" aria-labelledby="update-agent-profile-image-tab">
	                                <h5 class="mb-3">Update Agent Profile Image</h5>
	                                <form method="POST" action="" enctype="multipart/form-data">
	                                	<?php $csrf->echoInputField(); ?>
					                    <img class="img-fluid mb-3" src="./admin/assets/uploads/agents/<?php echo $_SESSION['customer']['image']; ?>" style="width: 100px;">
	                                	<div class="form-group col-md-4">
					                        <input type="file" class="form-control ml-1" name="image">
					                    </div>
					                    <div class="form-group">
					                        <button class="btn btn-sm btn-primary" name="update-agent-image">
					                        	Update Agent Image
					                        </button>
					                    </div>
	                                </form>
	                            </div>
	                            <div class="tab-pane fade show" id="update-agent-password" role="tabpanel" aria-labelledby="update-agent-password-tab">
	                                <h5 class="mb-3">Update Agent Profile Password</h5>
	                                <form method="POST" action="#">
	                                	<?php $csrf->echoInputField(); ?>
	                                	<div class="form-group d-flex col-md-8">
					                        <input type="password" class="form-control mr-1" name="password" placeholder="New Password">
					                        <input type="password" class="form-control ml-1" name="re_password" placeholder="Retype New Password">
					                    </div>
					                    <div class="form-group">
					                        <button class="btn btn-sm btn-primary" name="update-agent-password">
					                        	Update Agent Password
					                        </button>
					                    </div>
	                                </form>
	                            </div>
	                            <div class="tab-pane fade show" id="agent-properties" role="tabpanel" aria-labelledby="agent-properties-tab">
	                                <div class="property-area relative" id="property">
	                                	<h5 class="mb-3">Agent Posts</h5>
	                                	<div class="row">
											<?php
										        $i=0;
										        $statement = $pdo->prepare("SELECT * FROM properties INNER JOIN property_agent WHERE property_id=agent_id");
										        $statement->execute();
										        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

										        foreach ($result as $row) { $i++; ?>
												<div class="col-lg-4">
													<div class="single-property">
														<div class="images">
															<img class="img-fluid mx-auto d-block" src="./admin/assets/uploads/properties/<?php echo $row['featured_photo']; ?>" alt="">
															<span><?php echo $row['status'] ?></span>
														</div>

														<div class="desc">
															<div class="top d-flex justify-content-between">
																<h4>
																	<a href="property-show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
																</h4>
																<h4><?php echo number_format($row['price']) ?> RWF</h4>
															</div>
															<div class="middle">
																<div class="d-flex justify-content-start">
																	<p>Bed: <?php echo $row['bedroom'] ?></p>
																	<p>Bath: <?php echo $row['bathroom'] ?></p>
																	<p>Area: <?php echo $row['area'] ?> sqm</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
	                                </div>
	                            </div>
	                            <div class="tab-pane fade show" id="agent-add-property" role="tabpanel" aria-labelledby="agent-add-property-tab">
	                                <div class="property-area relative" id="property">
	                                	<h5 class="mb-3">Add Post</h5>
	                                	
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
				</div>
			</div>
		</div>
	</section>

	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>