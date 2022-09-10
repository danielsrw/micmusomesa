<?php
	// Create property
	if(isset($_POST['createProperty'])) {
		$valid = 1;

        if(empty($_POST['code'])) {
            $valid = 0;
            $error_message .= "Property code cannot be empty<br>";
        }

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Property Title cannot be empty<br>";
        }

	    if(empty($_POST['status'])) {
	        $valid = 0;
	        $error_message .= "Property Status cannot be empty<br>";
	    }

        if(empty($_POST['room'])) {
            $valid = 0;
            $error_message .= "Property Room cannot be empty<br>";
        }

        if(empty($_POST['bedroom'])) {
            $valid = 0;
            $error_message .= "Property Bedroom cannot be empty<br>";
        }

	    if(empty($_POST['bathroom'])) {
	        $valid = 0;
	        $error_message .= "Property Bathroom cannot be empty<br>";
	    }

	    if(empty($_POST['price'])) {
	        $valid = 0;
	        $error_message .= "Property Price cannot be empty<br>";
	    }

	    if(empty($_POST['area'])) {
	        $valid = 0;
	        $error_message .= "Property Area cannot be empty<br>";
	    }

	    if(empty($_POST['address'])) {
	        $valid = 0;
	        $error_message .= "Property Address cannot be empty<br>";
	    }

	    if(empty($_POST['neighborhood'])) {
	        $valid = 0;
	        $error_message .= "Property Neighborhood cannot be empty<br>";
	    }

	    if(empty($_POST['country'])) {
	        $valid = 0;
	        $error_message .= "Property Country cannot be empty<br>";
	    }

	    if(empty($_POST['district'])) {
	        $valid = 0;
	        $error_message .= "Property District cannot be empty<br>";
	    }

	    if(empty($_POST['sector'])) {
	        $valid = 0;
	        $error_message .= "Property Sector cannot be empty<br>";
	    }

	    if(empty($_POST['description'])) {
	        $valid = 0;
	        $error_message .= "Property Description cannot be empty<br>";
	    }

	    $path = $_FILES['featured_photo']['name'];
	    $path_tmp = $_FILES['featured_photo']['tmp_name'];

	    if($path!='') {
	        $ext = pathinfo( $path, PATHINFO_EXTENSION );
	        $file_name = basename( $path, '.' . $ext );
	        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
	            $valid = 0;
	            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
	        }
	    } else {
	    	$valid = 0;
	        $error_message .= 'You must have to select a featured photo<br>';
	    }


	    if($valid == 1) {

	    	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'properties'");
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row) {
				$ai_id=$row[10];
			}

	    	if( isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"]) )
	        {
	        	$photo = array();
	            $photo = $_FILES['photo']["name"];
	            $photo = array_values(array_filter($photo));

	        	$photo_temp = array();
	            $photo_temp = $_FILES['photo']["tmp_name"];
	            $photo_temp = array_values(array_filter($photo_temp));

	        	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'property_photos'");
				$statement->execute();
				$result = $statement->fetchAll();
				foreach($result as $row) {
					$next_id1=$row[10];
				}
				$z = $next_id1;

	            $m=0;
	            for($i=0;$i<count($photo);$i++)
	            {
	                $my_ext1 = pathinfo( $photo[$i], PATHINFO_EXTENSION );
			        if( $my_ext1=='jpg' || $my_ext1=='png' || $my_ext1=='jpeg' || $my_ext1=='gif' ) {
			            $final_name1[$m] = $z.'.'.$my_ext1;
	                    move_uploaded_file($photo_temp[$i],"./assets/uploads/property_photos/".$final_name1[$m]);
	                    $m++;
	                    $z++;
			        }
	            }

	            if(isset($final_name1)) {
	            	for($i=0;$i<count($final_name1);$i++)
			        {
			        	$statement = $pdo->prepare("INSERT INTO property_photos (photo, property_id) VALUES (?,?)");
			        	$statement->execute(array($final_name1[$i], $ai_id));
			        }
	            }
	        }

			$final_name = 'property-'.$ai_id.'.'.$ext;
	        move_uploaded_file( $path_tmp, './assets/uploads/properties/'.$final_name );

			//Saving data into the main table properties
			$statement = $pdo->prepare("INSERT INTO properties(code, name, status, room, bedroom, bathroom, price, price_bargain, area, builtup_area, year, video, address, neighborhood, country, district, sector, zip, featured_photo, views, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$statement->execute(array("MM", $_POST['name'], $_POST['status'], $_POST['room'], $_POST['bedroom'], $_POST['bathroom'], $_POST['price'], $_POST['price_bargain'], $_POST['area'], $_POST['builtup_area'], $_POST['year'], $_POST['video'], $_POST['address'], $_POST['neighborhood'], $_POST['country'], $_POST['district'], $_POST['sector'], $_POST['zip'], $final_name, 0, $_POST['description']));

			

	        if(isset($_POST['agent'])) {
				foreach($_POST['agent'] as $value) {
					$statement = $pdo->prepare("INSERT INTO property_agent (agent_id, property_id) VALUES (?,?)");
					$statement->execute(array($value, $ai_id));
				}
			}

			if(isset($_POST['feature'])) {
				foreach($_POST['feature'] as $value) {
					$statement = $pdo->prepare("INSERT INTO property_features (feature_id, property_id) VALUES (?,?)");
					$statement->execute(array($value, $ai_id));
				}
			}

			if(isset($_POST['type'])) {
				foreach($_POST['type'] as $value) {
					$statement = $pdo->prepare("INSERT INTO property_types (type_id, property_id) VALUES (?,?)");
					$statement->execute(array($value, $ai_id));
				}
			}
		
	    	$success_message = 'Property is added successfully.';
	    }
	}

	// Update property
	if(isset($_POST['updateProperty'])) {
        $valid = 1;

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Property name can not be empty<br>";
        }

        if(empty($_POST['status'])) {
            $valid = 0;
            $error_message .= "Property status can not be empty<br>";
        }

        if(empty($_POST['room'])) {
            $valid = 0;
            $error_message .= "Property room can not be empty<br>";
        }

        if(empty($_POST['bedroom'])) {
            $valid = 0;
            $error_message .= "Property bedroom can not be empty<br>";
        }

        if(empty($_POST['bathroom'])) {
            $valid = 0;
            $error_message .= "Property bathroom can not be empty<br>";
        }

        if(empty($_POST['price'])) {
            $valid = 0;
            $error_message .= "Property price can not be empty<br>";
        }

        if(empty($_POST['area'])) {
            $valid = 0;
            $error_message .= "Property area can not be empty<br>";
        }

        if(empty($_POST['address'])) {
            $valid = 0;
            $error_message .= "Property address can not be empty<br>";
        }

        if(empty($_POST['neighborhood'])) {
            $valid = 0;
            $error_message .= "Property neighborhood can not be empty<br>";
        }

        if(empty($_POST['district'])) {
            $valid = 0;
            $error_message .= "Property district can not be empty<br>";
        }

        if(empty($_POST['sector'])) {
            $valid = 0;
            $error_message .= "Property sector can not be empty<br>";
        }

        if(empty($_POST['description'])) {
            $valid = 0;
            $error_message .= "Property description can not be empty<br>";
        }

        $path = $_FILES['featured_photo']['name'];
        $path_tmp = $_FILES['featured_photo']['tmp_name'];

        if($path!='') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }


        if($valid == 1) {

            if( isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"]) )
            {

                $photo = array();
                $photo = $_FILES['photo']["name"];
                $photo = array_values(array_filter($photo));

                $photo_temp = array();
                $photo_temp = $_FILES['photo']["tmp_name"];
                $photo_temp = array_values(array_filter($photo_temp));

                $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'property_photos'");
                $statement->execute();
                $result = $statement->fetchAll();
                foreach($result as $row) {
                    $next_id1=$row[10];
                }
                $z = $next_id1;

                $m=0;
                for($i=0;$i<count($photo);$i++)
                {
                    $my_ext1 = pathinfo( $photo[$i], PATHINFO_EXTENSION );
                    if( $my_ext1=='jpg' || $my_ext1=='png' || $my_ext1=='jpeg' || $my_ext1=='gif' ) {
                        $final_name1[$m] = $z.'.'.$my_ext1;
                        move_uploaded_file($photo_temp[$i],"./assets/uploads/property_photos/".$final_name1[$m]);
                        $m++;
                        $z++;
                    }
                }

                if(isset($final_name1)) {
                    for($i=0;$i<count($final_name1);$i++)
                    {
                        $statement = $pdo->prepare("INSERT INTO property_photos (photo, property_id) VALUES (?, ?)");
                        $statement->execute(array($final_name1[$i], $_REQUEST['id']));
                    }
                }            
            }

            if($path == '') {
                $statement = $pdo->prepare("UPDATE properties SET 
                                        name=?, 
                                        status=?, 
                                        room=?, 
                                        bedroom=?, 
                                        bathroom=?,
                                        price=?,
                                        price_bargain=?,
                                        area=?,
                                        builtup_area=?,
                                        year=?,
                                        video=?,
                                        address=?,
                                        neighborhood=?,
                                        country=?,
                                        district=?
                                        sector=?
                                        zip=?
                                        description=?

                                        WHERE id=?");
                $statement->execute(array(
                                        $_POST['name'],
                                        $_POST['status'],
                                        $_POST['room'],
                                        $_POST['bedroom'],
                                        $_POST['bathroom'],
                                        $_POST['price'],
                                        $_POST['price_bargain'],
                                        $_POST['area'],
                                        $_POST['builtup_area'],
                                        $_POST['year'],
                                        $_POST['video'],
                                        $_POST['address'],
                                        $_POST['neighborhood'],
                                        "Rwanda",
                                        $_POST['district'],
                                        $_POST['sector'],
                                        $_POST['zip'],
                                        $_POST['description'],
                                        $_REQUEST['id']
                                    ));
            } else {

                unlink('./assets/uploads/properties/'.$_POST['current_photo']);

                $final_name = 'product-featured-'.$_REQUEST['id'].'.'.$ext;
                move_uploaded_file( $path_tmp, './assets/uploads/properties/'.$final_name );


                $statement = $pdo->prepare("UPDATE properties SET 
                                        name=?, 
                                        status=?, 
                                        room=?, 
                                        bedroom=?, 
                                        bathroom=?,
                                        price=?,
                                        price_bargain=?,
                                        area=?,
                                        builtup_area=?,
                                        year=?,
                                        video=?,
                                        address=?,
                                        neighborhood=?,
                                        country=?,
                                        district=?
                                        sector=?
                                        zip=?
                                        featured_photo=?,
                                        description=?

                                        WHERE id=?");
                $statement->execute(array(
                                        $_POST['name'],
                                        $_POST['status'],
                                        $_POST['room'],
                                        $_POST['bedroom'],
                                        $_POST['bathroom'],
                                        $_POST['price'],
                                        $_POST['price_bargain'],
                                        $_POST['area'],
                                        $_POST['builtup_area'],
                                        $_POST['year'],
                                        $_POST['video'],
                                        $_POST['address'],
                                        $_POST['neighborhood'],
                                        "Rwanda",
                                        $_POST['district'],
                                        $_POST['sector'],
                                        $_POST['zip'],
                                        $file_name,
                                        $_POST['description'],
                                        $_REQUEST['id']
                                    ));
            }
            

            if(isset($_POST['feature'])) {

                $statement = $pdo->prepare("DELETE FROM property_features WHERE property_id=?");
                $statement->execute(array($_REQUEST['id']));

                foreach($_POST['feature'] as $value) {
                    $statement = $pdo->prepare("INSERT INTO property_features (feature_id, property_id) VALUES (?,?)");
                    $statement->execute(array($value, $_REQUEST['id']));
                }
            } else {
                $statement = $pdo->prepare("DELETE FROM property_features WHERE property_id=?");
                $statement->execute(array($_REQUEST['id']));
            }

            if(isset($_POST['agent'])) {
            
                $statement = $pdo->prepare("DELETE FROM property_agent WHERE property_id=?");
                $statement->execute(array($_REQUEST['id']));

                foreach($_POST['agent'] as $value) {
                    $statement = $pdo->prepare("INSERT INTO property_agent (agent_id, property_id) VALUES (?,?)");
                    $statement->execute(array($value,$_REQUEST['id']));
                }
            } else {
                $statement = $pdo->prepare("DELETE FROM property_agent WHERE property_id=?");
                $statement->execute(array($_REQUEST['id']));
            }

            if(isset($_POST['type'])) {
            
                $statement = $pdo->prepare("DELETE FROM property_types WHERE property_id=?");
                $statement->execute(array($_REQUEST['id']));

                foreach($_POST['agent'] as $value) {
                    $statement = $pdo->prepare("INSERT INTO property_types (type_id, property_id) VALUES (?,?)");
                    $statement->execute(array($value,$_REQUEST['id']));
                }
            } else {
                $statement = $pdo->prepare("DELETE FROM property_types WHERE property_id=?");
                $statement->execute(array($_REQUEST['id']));
            }
        
            $success_message = 'Property is updated successfully.';
        }
    }

	// Create property type
	if (isset($_POST['createPropertyType'])) {
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
			$statement = $pdo->prepare("INSERT INTO types(name, status) VALUES (?,?)");

			$statement->execute(array($_POST['name'], $_POST['status']));
		
	    	$success_message = "Property type added successfully";
	    }
	}

	// Update property type
	if(isset($_POST['updatePropertyType'])) {
        $valid = 1;

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Property type can not be empty<br>";
        } else {
            // Duplicate Size checking
            // current size name that is in the database
            $statement = $pdo->prepare("SELECT * FROM types WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $current_name = $row['name'];
            }

            $statement = $pdo->prepare("SELECT * FROM types WHERE name=? and name!=?");
            $statement->execute(array($_POST['name'],$current_name));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= 'Property type already exists<br>';
            }
        }

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE types SET name=?, status=? WHERE id=?");
            $statement->execute(array($_POST['name'], $_POST['status'], $_REQUEST['id']));

            $success_message = 'Property type is updated successfully.';
        }
    }

	// Create property feature
	if (isset($_POST['createPropertyFeature'])) {
		$valid = 1;

	    if(empty($_POST['name'])) {
	        $valid = 0;
	        $error_message .= "Property feature can not be empty<br>";
	    } else {
	    	// Duplicate Category checking
	    	$statement = $pdo->prepare("SELECT * FROM features WHERE name=?");
	    	$statement->execute(array($_POST['name']));
	    	$total = $statement->rowCount();
	    	if($total)
	    	{
	    		$valid = 0;
	        	$error_message .= "Property feature already exists<br>";
	    	}
	    }

	    if($valid == 1) {

			// Saving data into the main table features
			$statement = $pdo->prepare("INSERT INTO features (name, status) VALUES (?,?)");
			$statement->execute(array($_POST['name'], $_POST['status']));
		
	    	$success_message = 'Property feature is added successfully.';
	    }
	}

	// Update property feature
    if(isset($_POST['updatePropertyFeature'])) {
        $valid = 1;

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Property feature can not be empty<br>";
        } else {
            // Duplicate Size checking
            // current size name that is in the database
            $statement = $pdo->prepare("SELECT * FROM features WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $current_name = $row['name'];
            }

            $statement = $pdo->prepare("SELECT * FROM features WHERE name=? and name!=?");
            $statement->execute(array($_POST['name'],$current_name));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= 'Property feature already exists<br>';
            }
        }

        if($valid == 1) {       
            // updating into the database
            $statement = $pdo->prepare("UPDATE features SET name=?, status=? WHERE id=?");
            $statement->execute(array($_POST['name'], $_POST['status'], $_REQUEST['id']));

            $success_message = 'Property feature is updated successfully.';
        }
    }

?>