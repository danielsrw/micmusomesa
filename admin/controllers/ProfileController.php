<?php
	if(isset($_POST['update-info'])) {

		if($_SESSION['user']['role'] == 'Super Admin') {

			$valid = 1;

		    if(empty($_POST['full_name'])) {
		        $valid = 0;
		        $error_message .= "Name can not be empty<br>";
		    }

		    if(empty($_POST['email'])) {
		        $valid = 0;
		        $error_message .= 'Email address can not be empty<br>';
		    } else {
		    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			        $valid = 0;
			        $error_message .= 'Email address must be valid<br>';
			    } else {
			    	// current email address that is in the database
			    	$statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
					$statement->execute(array($_SESSION['user']['id']));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach($result as $row) {
						$current_email = $row['email'];
					}

			    	$statement = $pdo->prepare("SELECT * FROM users WHERE email=? and email!=?");
			    	$statement->execute(array($_POST['email'],$current_email));
			    	$total = $statement->rowCount();							
			    	if($total) {
			    		$valid = 0;
			        	$error_message .= 'Email address already exists<br>';
			    	}
			    }
		    }

		    if($valid == 1) {
				
				$_SESSION['user']['full_name'] = $_POST['full_name'];
		    	$_SESSION['user']['email'] = $_POST['email'];

				// updating the database
				$statement = $pdo->prepare("UPDATE users SET full_name=?, email=?, phone=? WHERE id=?");
				$statement->execute(array($_POST['full_name'],$_POST['email'],$_POST['phone'],$_SESSION['user']['id']));

		    	$success_message = 'User Information is updated successfully.';
		    }
		}
		else {
			$_SESSION['user']['phone'] = $_POST['phone'];

			// updating the database
			$statement = $pdo->prepare("UPDATE users SET phone=? WHERE id=?");
			$statement->execute(array($_POST['phone'], $_SESSION['user']['id']));

			$success_message = 'User Information is updated successfully.';	
		}
	}

	if(isset($_POST['update-image'])) {

		$valid = 1;

		$path = $_FILES['photo']['name'];
	    $path_tmp = $_FILES['photo']['tmp_name'];

	    if($path!='') {
	        $ext = pathinfo( $path, PATHINFO_EXTENSION );
	        $file_name = basename( $path, '.' . $ext );
	        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
	            $valid = 0;
	            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
	        }
	    }

	    if($valid == 1) {

	    	// removing the existing photo
	    	if($_SESSION['user']['photo']!='') {
	    		unlink('./assets/uploads/profile/'.$_SESSION['user']['photo']);	
	    	}

	    	// updating the data
	    	$final_name = 'user-'.$_SESSION['user']['id'].'.'.$ext;
	        move_uploaded_file( $path_tmp, './assets/uploads/profile/'.$final_name );
	        $_SESSION['user']['photo'] = $final_name;

	        // updating the database
			$statement = $pdo->prepare("UPDATE users SET photo=? WHERE id=?");
			$statement->execute(array($final_name,$_SESSION['user']['id']));

	        $success_message = 'User Photo is updated successfully.';
	    	
	    }
	}

	if(isset($_POST['update-password'])) {
		$valid = 1;

		if( empty($_POST['password']) || empty($_POST['re_password']) ) {
	        $valid = 0;
	        $error_message .= "Password can not be empty<br>";
	    }

	    if( !empty($_POST['password']) && !empty($_POST['re_password']) ) {
	    	if($_POST['password'] != $_POST['re_password']) {
		    	$valid = 0;
		        $error_message .= "Passwords do not match<br>";	
	    	}        
	    }

	    if($valid == 1) {

	    	$_SESSION['user']['password'] = md5($_POST['password']);

	    	// updating the database
			$statement = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
			$statement->execute(array(md5($_POST['password']),$_SESSION['user']['id']));

	    	$success_message = 'User Password is updated successfully.';
	    }
	}
?>

<?php
	$statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
	$statement->execute(array($_SESSION['user']['id']));
	$statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$full_name = $row['full_name'];
		$email     = $row['email'];
		$phone     = $row['phone'];
		$photo     = $row['photo'];
		$status    = $row['status'];
		$role      = $row['role'];
	}
?>