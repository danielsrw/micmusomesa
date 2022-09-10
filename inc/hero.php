<?php
    $i=0;
    $statement = $pdo->prepare("SELECT * FROM settings");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) { $i++; ?>
		<section class="home-banner-area relative" id="home" style="background: url(./admin/assets/uploads/backgrounds/<?php echo $row['homeImage']; ?>) no-repeat center center/cover;">
	<?php }
?>
			<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row fullscreen align-items-end justify-content-center">
					<div class="banner-content col-lg-12 col-md-12">
						<h1>Let's help you find your dream property</h1>
						<div class="search-field">
							<form class="search-form" action="#" method="GET">
								<?php $csrf->echoInputField(); ?>
								<div class="row">
									<div class="col-lg-3 col-md-6 col-xs-6">
										<select name="s__status" class="app-select form-control" required>
											<option data-display="Property Status">Property Status</option>
											<option value="Rent">Rent</option>
											<option value="Sale">Sale</option>
										</select>
									</div>
									<div class="col-lg-3 col-md-6 col-xs-6">
										<select name="s__location" class="app-select form-control" required>
											<option data-display="Choose locations">Location</option>
											<?php
                                                $i=0;
                                                $statement = $pdo->prepare("SELECT * FROM districts ORDER BY id DESC");
                                                $statement->execute();
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($result as $row) { $i++; ?>
												<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-lg-3 col-md-6 col-xs-6">
										<select name="s__property_type" class="app-select form-control" required>
											<option data-display="Property Type">Property Type</option>
											<?php
							                    $i=0;
							                    $statement = $pdo->prepare("SELECT * FROM types WHERE status = 1 ORDER BY id DESC");
							                    $statement->execute();
							                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

							                    foreach ($result as $row) { $i++; ?>
												<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-lg-3 col-md-6 col-xs-6">
										<select name="s__price" class="app-select form-control" required>
											<option data-display="Price Range">Price Range</option>
											<option value="0-100000">0 - 100k</option>
											<option value="100000-200000">100k - 200k</option>
											<option value="300000">200k - 300k</option>
										</select>
									</div>
									<div class="col-lg-4 d-flex justify-content-end">
										<button class="primary-btn" name="search">
											Search Properties
											<span class="lnr lnr-arrow-right"></span>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>