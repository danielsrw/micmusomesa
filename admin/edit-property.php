<?php
    include('inc/css.php');
    require_once('controllers/PropertyController.php');

    if(!isset($_REQUEST['id'])) {
        header('location: logout.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $pdo->prepare("SELECT * FROM properties WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }

    $statement = $pdo->prepare("SELECT * FROM properties WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $id = $row['id'];
        $code = $row['code'];
        $name = $row['name'];
        $status = $row['status'];
        $room = $row['room'];
        $bedroom = $row['bedroom'];
        $bathroom = $row['bathroom'];
        $price = $row['price'];
        $price_bargain = $row['price_bargain'];
        $area = $row['area'];
        $builtup_area = $row['builtup_area'];
        $year = $row['year'];
        $video = $row['video'];
        $address = $row['address'];
        $neighborhood = $row['neighborhood'];
        $country = $row['country'];
        $district = $row['district'];
        $sector = $row['sector'];
        $zip = $row['zip'];
        $featured_photo = $row['featured_photo'];
        $description = $row['description'];
    }

    $statement = $pdo->prepare("SELECT * FROM property_features WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $feature_id[] = $row['feature_id'];
    }

    $statement = $pdo->prepare("SELECT * FROM property_agent WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $agent_id[] = $row['agent_id'];
    }

    $statement = $pdo->prepare("SELECT * FROM property_types WHERE property_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $type_id[] = $row['type_id'];
    }
?>
<body>

    <div class="container-scroller">
        <?php include('inc/nav.php') ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('inc/sidebar.php') ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <h5>Edit Property</h5>
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="view-property.php" class="btn btn-primary text-white me-0">
                                                <i class="icon-arrow-left"></i> Go Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Edit Property <?php echo $code ?>00<?php echo $id ?> <?php echo $name ?>
                                    </h4>
                                    <form class="form-sample" action="#" method="POST" enctype="multipart/form-data">
                                        <p>
                                            Property details
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Title</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <?php echo $code ?>00<?php echo $id ?>
                                                                </span>
                                                            </div>
                                                            <input type="hidden" name="code" value="<?php echo $code ?>" />
                                                            <input type="text" name="name" value="<?php echo $name ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control mt-2" name="status">
                                                            <option value="Rent" <?php if($status == "Rent"){echo 'selected';} ?>>Rent</option>
                                                            <option value="Sale" <?php if($status == "Sale"){echo 'selected';} ?>>Sale</option>
                                                            <option value="Rented" <?php if($status == "Rented"){echo 'selected';} ?>>Rented</option>
                                                            <option value="Sold" <?php if($status == "Sold"){echo 'selected';} ?>>Sold</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Agent</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control mt-2" name="agent[]">
                                                            <option>Choose Property Agent</option>
                                                            <?php
                                                                $is_select = '';
                                                                $statement = $pdo->prepare("SELECT * FROM agents");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($result as $row) {
                                                                    if(isset($agent_id)) {
                                                                        if(in_array($row['id'], $agent_id)) {
                                                                            $is_select = 'selected';
                                                                        } else {
                                                                            $is_select = '';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $row['id']; ?>" <?php echo $is_select; ?>><?php echo $row['name']; ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control mt-2" name="type[]">
                                                            <option>Choose Property Type</option>
                                                            <?php
                                                                $is_select = '';
                                                                $statement = $pdo->prepare("SELECT * FROM types");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($result as $row) {
                                                                    if(isset($type_id)) {
                                                                        if(in_array($row['id'], $type_id)) {
                                                                            $is_select = 'selected';
                                                                        } else {
                                                                            $is_select = '';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $row['id']; ?>" <?php echo $is_select; ?>><?php echo $row['name']; ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Room(s)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="room" value="<?php echo $room ?>" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Bedroom(s)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="bedroom" value="<?php echo $bedroom ?>" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Bathroom(s)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="bathroom" value="<?php echo $bathroom ?>" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Price</label>
                                                    <div class="col-sm-10 mt-2">
                                                        <div class="input-group">
                                                            <select class="form-control" name="price_bargain">
                                                                <option value="Negotiable" <?php if($price_bargain == "Negotiable"){echo 'selected';} ?>>Negotiable</option>
                                                                <option value="Not Negotiable" <?php if($price_bargain == "Not Negotiable"){echo 'selected';} ?>>Not Negotiable</option>
                                                            </select>
                                                            <input type="number" name="price" value="<?php echo $price ?>" class="form-control" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">RWF</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Plot Area</label>
                                                    <div class="col-sm-8 mt-2">
                                                        <div class="input-group">
                                                            <input type="number" value="<?php echo $area ?>" name="area" class="form-control" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">SQM</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Built-up Area</label>
                                                    <div class="col-sm-8 mt-2">
                                                        <div class="input-group">
                                                            <input type="number" name="builtup_area" value="<?php echo $builtup_area ?>" class="form-control" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">SQM</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Year Built</label>
                                                    <div class="col-sm-8 mt-2">
                                                        <input type="number" name="year" value="<?php echo $year ?>" class="form-control" />
                                                        <p style="color: green">
                                                            You can leave this empty if you want
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Video</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <input type="url" name="video" value="<?php echo $video ?>" class="form-control" />
                                                        <p style="color: green">
                                                            You can leave this empty if you want
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            Property Location
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Address</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <input type="text" name="address" value="<?php echo $address ?>" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Neighborhood</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <input type="text" name="neighborhood" value="<?php echo $neighborhood ?>" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Country</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <input type="text" name="country" value="Rwanda" class="form-control" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">District</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control mt-2" name="district">
                                                            <option>Choose District</option>
                                                            <?php
                                                                $statement = $pdo->prepare("SELECT * FROM districts");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);   
                                                                foreach ($result as $row) { ?>
                                                                <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $district){echo 'selected';} ?>><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Sector</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <input type="text" name="sector" class="form-control" value="<?php echo $sector ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Feature</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <select class="js-example-basic-multiple w-100" name="feature[]" multiple="multiple">
                                                            <?php
                                                                $is_select = '';
                                                                $statement = $pdo->prepare("SELECT * FROM features");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($result as $row) {
                                                                    if(isset($feature_id)) {
                                                                        if(in_array($row['id'], $feature_id)) {
                                                                            $is_select = 'selected';
                                                                        } else {
                                                                            $is_select = '';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $row['id']; ?>" <?php echo $is_select; ?>><?php echo $row['name']; ?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Postal Code</label>
                                                    <div class="col-sm-9 mt-2">
                                                        <input type="text" name="zip" value="<?php echo $zip ?>" class="form-control" />
                                                        <p style="color: green">
                                                            You can leave this empty if you want
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Current</label>
                                                    <div class="col-sm-9">
                                                        <img src="./assets/uploads/properties/<?php echo $featured_photo; ?>" style='width: 100px;'>
                                                        <input type="hidden" name="current_photo" value="<?php echo $featured_photo; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Featured Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="featured_photo" class="form-control mt-2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Other Images</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="photo[]" class="form-control mt-2">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <table>
                                                    <tbody>
                                                        <?php
                                                            $statement = $pdo->prepare("SELECT * FROM property_photos WHERE property_id=?");
                                                            $statement->execute(array($_REQUEST['id']));
                                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($result as $row) { ?>
                                                            <tr>
                                                                <td>
                                                                    <img src="./assets/uploads/property_photos/<?php echo $row['photo']; ?>" style='width: 100px;'>
                                                                </td>
                                                                <td>
                                                                    <a onclick="return confirmDelete();" href="delete-property-photo.php?id=<?php echo $row['id']; ?>&id1=<?php echo $_REQUEST['id']; ?>" class="btn btn-sm btn-danger btn-xs">X</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10 mt-2">
                                                        <textarea class="form-control" rows="5" name="description" style="height: 200px;"><?php echo $description ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="hidden" name="views" value="0">
                                                <button type="submit" name="updateProperty" class="btn btn-primary me-2">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/js.php') ?>