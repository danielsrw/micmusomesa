<?php
	
	// Create
	if(isset($_POST['create-home-image'])) {
		$valid = 1;

		$path = $_FILES['homeImage']['name'];
	    $path_tmp = $_FILES['homeImage']['tmp_name'];

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
			$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'settings'");
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row) {
				$ai_id=$row[10];
			}


			$final_name = 'homeImage-'.$ai_id.'.'.$ext;
	        move_uploaded_file( $path_tmp, './assets/uploads/backgrounds/'.$final_name );

		
			$statement = $pdo->prepare("INSERT INTO settings (homeImage, alt) VALUES (?, ?)");
			$statement->execute(array($final_name, $_POST['alt']));
				
			$success_message = 'Home image is added successfully!';

			unset($_POST['alt']);
		}
	}

	// Update Hero Background
	if(isset($_POST['update-home-image'])) {
		$valid = 1;

		
	    $path = $_FILES['homeImage']['name'];
	    $path_tmp = $_FILES['homeImage']['tmp_name'];

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
				$statement = $pdo->prepare("UPDATE settings SET alt=? WHERE id=?");
	    		$statement->execute(array($_POST['alt'], $_REQUEST['id']));
			} else {

				// unlink('./assets/uploads/backgrounds/'.$_POST['current_photo']);

				$final_name = 'homeImage-'.$_REQUEST['id'].'.'.$ext;
	        	move_uploaded_file( $path_tmp, './assets/uploads/backgrounds/'.$final_name );

	        	$statement = $pdo->prepare("UPDATE settings SET homeImage=?, alt=? WHERE id=?");
	    		$statement->execute(array($final_name, $_POST['alt'], $_REQUEST['id']));
			}	   

		    $success_message = 'Home image is updated successfully!';
		}
	}

	// Update About Background
	if(isset($_POST['update-about-image'])) {
		$valid = 1;

		
	    $path = $_FILES['aboutImage']['name'];
	    $path_tmp = $_FILES['aboutImage']['tmp_name'];

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
				$statement = $pdo->prepare("UPDATE settings SET alt=? WHERE id=?");
	    		$statement->execute(array($_POST['alt'], $_REQUEST['id']));
			} else {

				// unlink('./assets/uploads/backgrounds/'.$_POST['current_photo']);

				$final_name = 'aboutImage-'.$_REQUEST['id'].'.'.$ext;
	        	move_uploaded_file( $path_tmp, './assets/uploads/backgrounds/'.$final_name );

	        	$statement = $pdo->prepare("UPDATE settings SET aboutImage=?, alt=? WHERE id=?");
	    		$statement->execute(array($final_name, $_POST['alt'], $_REQUEST['id']));
			}	   

		    $success_message = 'About background image is updated successfully!';
		}
	}

	// Update Default Background
	if(isset($_POST['update-default-image'])) {
		$valid = 1;

		
	    $path = $_FILES['defaultImage']['name'];
	    $path_tmp = $_FILES['defaultImage']['tmp_name'];

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
				$statement = $pdo->prepare("UPDATE settings SET alt=? WHERE id=?");
	    		$statement->execute(array($_POST['alt'], $_REQUEST['id']));
			} else {

				// unlink('./assets/uploads/backgrounds/'.$_POST['current_photo']);

				$final_name = 'defaultImage-'.$_REQUEST['id'].'.'.$ext;
	        	move_uploaded_file( $path_tmp, './assets/uploads/backgrounds/'.$final_name );

	        	$statement = $pdo->prepare("UPDATE settings SET defaultImage=?, alt=? WHERE id=?");
	    		$statement->execute(array($final_name, $_POST['alt'], $_REQUEST['id']));
			}	   

		    $success_message = 'Default background image is updated successfully!';
		}
	}

	// Update Social Media
    if (isset($_POST['updateSocialMedia'])) {
        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['facebook'],'Facebook'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['twitter'],'Twitter'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['instagram'],'Instagram'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['youtube'],'Youtube'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['whatsapp'],'Whatsapp'));

        $statement = $pdo->prepare("UPDATE social_media SET url=? WHERE name=?");
        $statement->execute(array($_POST['linkedin'],'LinkedIn'));

        $success_message = 'Social Media URLs are updated successfully.';
    }

    // Add Districts
    if (isset($_POST['createDistrict'])) {
    	$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "District name can not be empty<br>";
	    } else {
	    	// Duplicate Category checking
	    	$statement = $pdo->prepare("SELECT * FROM districts WHERE name=?");
	    	$statement->execute(array($_POST['name']));
	    	$total = $statement->rowCount();
	    	if($total)
	    	{
	    		$valid = 0;
	        	$error_message .= "District name already exists<br>";
	    	}
	    }

	    if($valid == 1) {

			// Saving data into the main table districts
			$statement = $pdo->prepare("INSERT INTO districts (name) VALUES (?)");
			$statement->execute(array($_POST['name']));
		
	    	$success_message = 'District name is added successfully.';
	    }
    }

    if (isset($_POST['updateDistrict'])) {
    	$valid = 1;

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "District name can not be empty<br>";
        } else {
            // Duplicate Size checking
            // current size name that is in the database
            $statement = $pdo->prepare("SELECT * FROM districts WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $current_name = $row['name'];
            }

            $statement = $pdo->prepare("SELECT * FROM districts WHERE name=? and name!=?");
            $statement->execute(array($_POST['name'],$current_name));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= 'District name already exists<br>';
            }
        }

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE districts SET name=? WHERE id=?");
            $statement->execute(array($_POST['name'], $_REQUEST['id']));

            $success_message = 'District name is updated successfully.';
        }
    }
?>