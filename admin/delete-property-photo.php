<?php

	include('inc/css.php');
    include('controllers/PropertyController.php');

	if( !isset($_REQUEST['id']) || !isset($_REQUEST['id1']) ) {
		header('location: logout.php');
		exit;
	} else {
		// Check the id is valid or not
		$statement = $pdo->prepare("SELECT * FROM property_photos WHERE id=?");
		$statement->execute(array($_REQUEST['id']));
		$total = $statement->rowCount();
		if( $total == 0 ) {
			header('location: logout.php');
			exit;
		}
	}

	// Getting photo ID to unlink from folder
	$statement = $pdo->prepare("SELECT * FROM property_photos WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$photo = $row['photo'];
	}

	// Unlink the photo
	if($photo!='') {
		unlink('./assets/uploads/property_photos/' . $photo);	
	}

	// Delete from tbl_testimonial
	$statement = $pdo->prepare("DELETE FROM property_photos WHERE id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: edit-property.php?id=' . $_REQUEST['id1']);

?>