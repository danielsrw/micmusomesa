<?php

	if(isset($_POST['login'])) {
        
	    if(empty($_POST['email']) || empty($_POST['password'])) {
	        $error_message = 'Email and/or Password can not be empty<br>';
	    } else {
			
			$email = strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);

	    	$statement = $pdo->prepare("SELECT * FROM users WHERE email=? AND status=?");
	    	$statement->execute(array($email,'Active'));
	    	$total = $statement->rowCount();    
	        $result = $statement->fetchAll(PDO::FETCH_ASSOC);    
	        if($total==0) {
	            $error_message .= 'Email Address does not match<br>';
	        } else {       
	            foreach($result as $row) { 
	                $row_password = $row['password'];
	            }
	        
	            if( $row_password != md5($password) ) {
	                $error_message .= 'Password does not match<br>';
	            } else {       
	            
					$_SESSION['user'] = $row;
	                header("location: dashboard.php");
	            }
	        }
	    }
	}

?>