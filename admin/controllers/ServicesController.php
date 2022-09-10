<?php

	if (isset($_POST['create'])) {
		$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "Name field cannot be empty<br>";
	    }

	    if(empty($_POST['status'])) {
	        $valid = 0;
	        $error_message .= "Status field cannot be empty<br>";
	    }

	    if(empty($_POST['description'])) {
	        $valid = 0;
	        $error_message .= "Description field cannot be empty<br>";
	    }

	    if($valid == 1) {

			//Saving data into the main table tbl_end_category
			$statement = $pdo->prepare("INSERT INTO services(name, status, description) VALUES (?,?,?)");

			$statement->execute(array($_POST['name'], $_POST['status'], $_POST['description']));
		
	    	$success_message = "Service added succesfully";
	    }
	}

	if(isset($_POST['update'])) {
		$valid = 1;

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Service name can not be empty<br>";
        } else {
            // Duplicate Size checking
            // current size name that is in the database
            $statement = $pdo->prepare("SELECT * FROM services WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $current_name = $row['name'];
            }

            $statement = $pdo->prepare("SELECT * FROM services WHERE name=? and name!=?");
            $statement->execute(array($_POST['name'],$current_name));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= 'Service name already exists<br>';
            }
        }

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE services SET name=?, status=?, description=? WHERE id=?");
            $statement->execute(array($_POST['name'], $_POST['status'], $_POST['description'], $_REQUEST['id']));

            $success_message = 'Service is updated successfully.';
        }
	}

?>