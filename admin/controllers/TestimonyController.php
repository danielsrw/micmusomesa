<?php
	if(isset($_POST['submit'])) {
		$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "Name field cannot be empty<br>";
	    }

	    if(empty($_POST['title'])) {
	        $valid = 0;
	        $error_message .= "Title field cannot be empty<br>";
	    }

	    if(empty($_POST['gender'])) {
	        $valid = 0;
	        $error_message .= "Gender field cannot be empty<br>";
	    }

	    if(empty($_POST['message'])) {
	        $valid = 0;
	        $error_message .= "Message field cannot be empty<br>";
	    }

	    if($valid == 1) {

			//Saving data into the main table tbl_end_category
			$statement = $pdo->prepare("INSERT INTO testimonies(name, title, gender, message) VALUES (?,?,?,?)");

			$statement->execute(array($_POST['name'], $_POST['title'], $_POST['gender'], $_POST['message']));
		
	    	$success_message = "We appreciate taking your time and give us your testimony, Thank you 😊";
	    }
	}

	if (isset($_POST['updateTestimonyStatus'])) {
		$valid = 1;

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE testimonies SET status=? WHERE id=?");
            $statement->execute(array($_POST['status'], $_REQUEST['id']));

            $success_message = 'Testimony status is updated successfully.';
        }
	}
?>