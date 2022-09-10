<?php
	// Create
	if(isset($_POST['create'])) {
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
			$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'teams'");
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row) {
				$ai_id=$row[10];
			}


			$final_name = 'team-'.$ai_id.'.'.$ext;
	        move_uploaded_file( $path_tmp, './assets/uploads/team/'.$final_name );

		
			$statement = $pdo->prepare("INSERT INTO teams (name, position, status, phone, email, image) VALUES (?,?,?,?,?,?)");
			$statement->execute(array($_POST['name'], $_POST['position'], $_POST['status'], $_POST['phone'], $_POST['email'], $final_name));
				
			$success_message = 'Team member is added successfully!';

			unset($_POST['name']);
			unset($_POST['position']);
			unset($_POST['status']);
			unset($_POST['phone']);
			unset($_POST['email']);
		}
	}

	// Edit
	if(isset($_POST['update'])) {
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
				$statement = $pdo->prepare("UPDATE teams SET name=?, status=?, phone=?, email=?, position=? WHERE id=?");
	    		$statement->execute(array($_POST['name'],$_POST['status'],$_POST['phone'],$_POST['email'],$_POST['position'],$_REQUEST['id']));
			} else {

				// unlink('./assets/uploads/team/'.$_POST['current_photo']);

				$final_name = 'team-'.$_REQUEST['id'].'.'.$ext;
	        	move_uploaded_file( $path_tmp, './assets/uploads/team/'.$final_name );

	        	$statement = $pdo->prepare("UPDATE teams SET image=?, name=?, status=?, phone=?, email=?, position=? WHERE id=?");
	    		$statement->execute(array($final_name,$_POST['name'],$_POST['status'],$_POST['phone'],$_POST['email'],$_POST['position'],$_REQUEST['id']));
			}	   

		    $success_message = 'Team member is updated successfully!';
		}
	}
?>