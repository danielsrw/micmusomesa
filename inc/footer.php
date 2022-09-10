<style>
	ul li a {
		color: #777;
	}

	ul li a i {
		color: #777;
		padding: 10px;
	}
	
	ul li a:hover, ul li a i:hover {
		color: white;
	}
</style>

<footer class="footer-area section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h6>Useful Links</h6>
					<ul>
						<li>
							<a href="join-us.php">
								<i class="fa fa-link"></i>Join Us
							</a>
						</li>
						<li>
							<a href="faq.php">
								<i class="fa fa-link"></i>FAQ
							</a>
						</li>
						<li>
							<a href="terms-and-conditions.php">
								<i class="fa fa-link"></i>Terms & Conditions
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h6>Projects</h6>
					<ul>
						<?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM projects WHERE status = 1 ORDER BY id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) { $i++; ?>
							<li>
								<a href="project-show.php?id=<?php echo $row['id'] ?>">
									<i class="fa fa-link"></i><?php echo $row['name'] ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h6>Services</h6>
					<ul>
						<?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM services WHERE status = 1 ORDER BY id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) { $i++; ?>
							<li>
								<a href="service-show.php?id=<?php echo $row['id'] ?>">
									<i class="fa fa-link"></i><?php echo $row['name'] ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-footer-widget">
					<h6>Contact Us</h6>
					<p>Address: Kigali, Rwanda, Kisimenti, Rukiri ||, Street 18 KG Avenue</p>
					<p>Email: info@micmusomesa.com</p>
					<p>Phone Number: +250 790 140 002</p>
				</div>
			</div>
		</div>
		<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
			<p class="footer-text m-0">
				Copyright &copy;
				<script>document.write(new Date().getFullYear());</script> 
				All rights reserved Musomesa | Developed by 
				<a href="" target="_blank">
					NE<span style="color: red;">X</span>CODE
				</a>
			</p>
		</div>
	</div>
</footer>