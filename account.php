	<?php
		include('inc/css.php');
		include('admin/controllers/AgentsController.php');
	?>

	<title>Account | MUSOMESA</title>
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
						<a href="account.php">
							Apply
						</a>
					</p>
					<h2 class="text-white">
						Apply to be one of our agents
					</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 header-text">
					<h1>Welcome to Musomesa LTD</h1>
					<p>
						Create agents account and upload your properties
					</p>
					<?php include('./admin/inc/message.php') ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5">
					<h4>Sign In</h4>
					<p>
						You'll wait for admin's approval to sign in
					</p>
					<form class="row contact_form" action="" method="POST">
						<?php $csrf->echoInputField(); ?> 
						<div class="col-md-12">
							<div class="form-group">
								<input type="email" class="form-control" name="email" placeholder="Enter email address">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Enter password">
							</div>
						</div>
						<div class="col-md-12 d-flex justify-content-between">
							<a href="">
								Forget Password
							</a>
							<button type="submit" name="signin" class="btn primary-btn">Sign In</button>
						</div>
					</form>
				</div>
				<div class="col-lg-7">
					<h4>Sign Up</h4>
					<p>
						Fill this form if you don't have an account here yet!
					</p>
					<form class="row contact_form" action="" method="POST">
						<?php $csrf->echoInputField(); ?>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control"  name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" placeholder="Enter your name">
							</div>
							<div class="form-group d-flex">
								<input type="email" class="form-control w-50 mr-1" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" name="email" placeholder="Enter email address">
								<input type="number" class="form-control w-50 ml-1" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>"  name="phone" placeholder="Enter your phone number" max-length='10'>
							</div>
							<div class="form-group">
								<input type="hidden" name="status" value="0">
								<input type="hidden" name="image" value="default.png">
								<input type="hidden" name="address" value="Address">
								<input type="hidden" name="description" value="Description">
							</div>
							<div class="form-group d-flex">
								<input type="password" class="form-control w-50 mr-1" name="password" placeholder="Password">
								<input type="password" class="form-control w-50 ml-1" name="confirm_password" placeholder="Confirm Password">
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="submit" name="signup" class="btn btn-sm primary-btn">Sign Up</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include('inc/footer.php') ?>

	<?php include('inc/js.php') ?>