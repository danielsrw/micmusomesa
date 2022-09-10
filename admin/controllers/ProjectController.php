<?php

	// Create project category
	if (isset($_POST['createProjectCategory'])) {
		$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "Name field cannot be empty<br>";
	    }

	    if(empty($_POST['status'])) {
	        $valid = 0;
	        $error_message .= "Status field cannot be empty<br>";
	    }

	    if($valid == 1) {

			//Saving data into the main table tbl_end_category
			$statement = $pdo->prepare("INSERT INTO categories(name, status) VALUES (?,?)");

			$statement->execute(array($_POST['name'], $_POST['status']));
		
	    	$success_message = "Project category added successfully";
	    }
	}

	// Update project category
	if (isset($_POST['updateProjectCategory'])) {
		$valid = 1;

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Project category name can not be empty<br>";
        } else {
            // Duplicate Size checking
            // current size name that is in the database
            $statement = $pdo->prepare("SELECT * FROM categories WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $current_name = $row['name'];
            }

            $statement = $pdo->prepare("SELECT * FROM categories WHERE name=? and name!=?");
            $statement->execute(array($_POST['name'],$current_name));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= 'Project category name already exists<br>';
            }
        }

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE categories SET name=?, status=? WHERE id=?");
            $statement->execute(array($_POST['name'], $_POST['status'], $_REQUEST['id']));

            $success_message = 'Project category is updated successfully.';
        }
	}

	// Create project
	if (isset($_POST['createProject'])) {
		$valid = 1;

		$path = $_FILES['image']['name'];
	    $path_tmp = $_FILES['image']['tmp_name'];

	    if($path!='') {
	        $ext = pathinfo( $path, PATHINFO_EXTENSION );
	        $file_name = basename( $path, '.' . $ext );
	        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
	            $valid = 0;
	            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
	        }
	    } else {
	    	$valid = 0;
	        $error_message .= 'You must have to select a photo<br>';
	    }

		if($valid == 1) {

			// getting auto increment id
			$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'projects'");
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row) {
				$ai_id=$row[10];
			}


			$final_name = 'projects-'.$ai_id.'.'.$ext;
	        move_uploaded_file( $path_tmp, './assets/uploads/projects/'.$final_name );

		
			$statement = $pdo->prepare("INSERT INTO projects (name, image, category, status, description) VALUES (?,?,?,?,?)");
			$statement->execute(array($_POST['name'], $final_name, $_POST['category'], $_POST['status'], $_POST['description']));
				
			$success_message = 'Project is added successfully!';

			unset($_POST['name']);
			unset($_POST['category']);
			unset($_POST['status']);;
			unset($_POST['description']);;
		}
	}

	// Update project
	if (isset($_POST['updateProject'])) {
		$valid = 1;

	    $path = $_FILES['image']['name'];
	    $path_tmp = $_FILES['image']['tmp_name'];

	    if($path!='') {
	        $ext = pathinfo( $path, PATHINFO_EXTENSION );
	        $file_name = basename( $path, '.' . $ext );
	        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
	            $valid = 0;
	            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
	        }
	    }

		if($valid == 1) {

			if($path == '') {
				$statement = $pdo->prepare("UPDATE projects SET name=?, category=?, status=?, description=? WHERE id=?");
	    		$statement->execute(array($_POST['name'], $_POST['category'], $_POST['status'], $_POST['description'], $_REQUEST['id']));
			} else {

				// unlink('./assets/uploads/projects/'.$_POST['current_photo']);

				$final_name = 'projects-'.$_REQUEST['id'].'.'.$ext;
	        	move_uploaded_file( $path_tmp, './assets/uploads/projects/'.$final_name );

	        	$statement = $pdo->prepare("UPDATE projects SET image=?, name=?, category=?, status=?, description=? WHERE id=?");
	    		$statement->execute(array($final_name, $_POST['name'], $_POST['category'], $_POST['status'], $_POST['description'], $_REQUEST['id']));
			}	   

		    $success_message = 'Project is updated successfully!';
		}
	}
?>