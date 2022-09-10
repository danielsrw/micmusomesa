<?php

	// Create agent
	if (isset($_POST['signup'])) {
		$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= 'Name field cannot be empty <br>';
	    }

	    if(empty($_POST['email'])) {
	        $valid = 0;
	        $error_message .= 'Email field cannot be empty';
	    } else {
	        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	            $valid = 0;
	            $error_message .= "Email address must be valid. <br>";
	        } else {
	            $statement = $pdo->prepare("SELECT * FROM agents WHERE email=?");
	            $statement->execute(array($_POST['email']));
	            $total = $statement->rowCount();                            
	            if($total) {
	                $valid = 0;
	                $error_message .= "Email already exist <br>";
	            }
	        }
	    }

	    if(empty($_POST['phone'])) {
	        $valid = 0;
	        $error_message .= 'Phone number field cannot be empty <br>';
	    }

	    if( empty($_POST['password']) || empty($_POST['confirm_password']) ) {
	        $valid = 0;
	        $error_message .= "Password field cannot be empty <br>";
	    }

	    if( !empty($_POST['password']) && !empty($_POST['confirm_password']) ) {
	        if($_POST['password'] != $_POST['confirm_password']) {
	            $valid = 0;
	            $error_message .= "Passwords do not match. <br>";
	        }
	    }

	    if($valid == 1) {
	        $created_at = date('Y-m-d h:i:s');

	        $statement = $pdo->prepare("INSERT INTO agents (name, email, phone, status, image, address, description, password, created_at) VALUES (?,?,?,?,?,?,?,?,?)");

	        $statement->execute(array(strip_tags($_POST['name']), strip_tags($_POST['email']),  strip_tags($_POST['phone']), strip_tags($_POST['status']), strip_tags($_POST['image']), strip_tags($_POST['address']), strip_tags($_POST['description']), md5($_POST['password']), $created_at));
	    }

	    unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['phone']);
        unset($_POST['status']);
        unset($_POST['image']);
        unset($_POST['address']);
        unset($_POST['description']);
        unset($_POST['password']);

        $success_message = 'Your registration is completed.';
	}

	// Sign in agent
	if(isset($_POST['signin'])) {
		        
	    if(empty($_POST['email']) || empty($_POST['password'])) {
	        $error_message = "Email and/or Password can not be empty.";
	    } else {
	        
	        $email = strip_tags($_POST['email']);
	        $password = strip_tags($_POST['password']);

	        $statement = $pdo->prepare("SELECT * FROM agents WHERE email=?");
	        $statement->execute(array($email));
	        $total = $statement->rowCount();
	        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	        foreach($result as $row) {
	            $status = $row['status'];
	            $row_password = $row['password'];
	        }

	        if($total==0) {
	            $error_message .= "Email Address does not match.";
	        } else {
	            //using MD5 form
	            if( $row_password != md5($password) ) {
	                $error_message .= "Password do not match.";
	            } else {
	                if($status == 0) {
	                    $error_message .= "Sorry! Your account is inactive. Please contact to the administrator.";
	                } else {
	                    $_SESSION['customer'] = $row;
	                    header("location: " . BASE_URL . "agent-profile.php");
	                }
	            }
	            
	        }
	    }
	}

	// Update agent profile
	if (isset($_POST['update-agent-profile'])) {

	    $valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "Name cannot be empty <br>";
	    }

	    if(empty($_POST['email'])) {
	        $valid = 0;
	        $error_message .= "Email cannot be empty <br>";
	    }

	    if(empty($_POST['phone'])) {
	        $valid = 0;
	        $error_message .= "Phone cannot be empty <br>";
	    }

	    if(empty($_POST['address'])) {
	        $valid = 0;
	        $error_message .= "Address cannot be empty <br>";
	    }

	    if(empty($_POST['description'])) {
	        $valid = 0;
	        $error_message .= "Description cannot be empty <br>";
	    }

	    if($valid == 1) {

	        // update data into the database
	        $statement = $pdo->prepare("UPDATE agents SET name=?, phone=?, email=?, address=?, description=? WHERE id=?");
	        $statement->execute(array(
	                    strip_tags($_POST['name']),
	                    strip_tags($_POST['phone']),
	                    strip_tags($_POST['email']),
	                    strip_tags($_POST['address']),
	                    strip_tags($_POST['description']),
	                    $_SESSION['customer']['id']
	                ));  
	       
	        $success_message = "Your profile is updated successfully";

	        $_SESSION['customer']['name'] = $_POST['name'];
	        $_SESSION['customer']['phone'] = $_POST['phone'];
	        $_SESSION['customer']['email'] = $_POST['email'];
	        $_SESSION['customer']['address'] = $_POST['address'];
	        $_SESSION['customer']['description'] = $_POST['description'];
	    }
	}

	// Update agent image
	if(isset($_POST['update-agent-image'])) {

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

	    	// removing the existing image
	    	if($_SESSION['customer']['image']!='') {
	    		// unlink('./admin/assets/uploads/agents/'.$_SESSION['customer']['image']);	
	    	}

	    	// updating the data
	    	$final_name = 'agent-'.$_SESSION['customer']['id'].'.'.$ext;
	        move_uploaded_file( $path_tmp, './admin/assets/uploads/agents/'.$final_name );
	        $_SESSION['customer']['image'] = $final_name;

	        // updating the database
			$statement = $pdo->prepare("UPDATE agents SET image=? WHERE id=?");
			$statement->execute(array($final_name,$_SESSION['customer']['id']));

	        $success_message = 'Profile image is updated successfully.';
	    	
	    }
	}

	// Update agent password
	if (isset($_POST['update-agent-password'])) {
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
			$statement = $pdo->prepare("UPDATE agents SET password=? WHERE id=?");
			$statement->execute(array(md5($_POST['password']),$_SESSION['user']['id']));

	    	$success_message = 'User Password is updated successfully.';
	    }
	}

	if (isset($_POST['updateAgentStatus'])) {
		$valid = 1;

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE agents SET status=? WHERE id=?");
            $statement->execute(array($_POST['status'], $_REQUEST['id']));

            $success_message = 'Agent status is updated successfully.';
        }
	}
?>