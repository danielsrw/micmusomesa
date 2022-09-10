<?php
	if(isset($_POST['submit'])) {
		$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "Name field cannot be empty<br>";
	    }

	    if(empty($_POST['email'])) {
	        $valid = 0;
	        $error_message .= "Email field cannot be empty<br>";
	    }

	    if(empty($_POST['phone'])) {
	        $valid = 0;
	        $error_message .= "Phone field cannot be empty<br>";
	    }

	    if(empty($_POST['message'])) {
	        $valid = 0;
	        $error_message .= "Message field cannot be empty<br>";
	    }

	    if($valid == 1) {

			//Saving data into the main table tbl_end_category
			$statement = $pdo->prepare("INSERT INTO contacts(name, email, phone, message) VALUES (?,?,?,?)");

			$statement->execute(array($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']));
		
	    	$success_message = "Thank you for contacting us, we'll get back to you soon!";
	    }
	}
?>