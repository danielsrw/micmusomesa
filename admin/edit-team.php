<?php
    include('inc/css.php');
    require_once('controllers/TeamController.php');

    if(!isset($_REQUEST['id'])) {
        header('location: logout.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $pdo->prepare("SELECT * FROM teams WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }
    }

    $statement = $pdo->prepare("SELECT * FROM teams WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $image = $row['image'];
        $name = $row['name'];
        $position = $row['position'];
        $status = $row['status'];
        $phone = $row['phone'];
        $email = $row['email'];
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
                                <h5>Add Team Member</h5>
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="view-team.php" class="btn btn-primary text-white me-0">
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
                                    <form class="forms-sample" action="#" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="name" class="form-control mt-2" value="<?php echo $name ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Position</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="position" value="<?php echo $position ?>" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Phone Number</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="phone" class="form-control mt-2" value="<?php echo $phone ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="email" class="form-control mt-2" value="<?php echo $email ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control mt-2" name="status">
                                                            <option value="1" <?php if($status == 0){echo 'selected';} ?>>On</option>
                                                            <option value="0" <?php if($status == 0){echo 'selected';} ?>>Off</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" name="current_photo" value="./assets/uploads/team/<?php echo $image ?>">
                                                        <img class="img-fluid mb-3" src="./assets/uploads/team/<?php echo $image ?>" style="width: 30px;">
                                                        <input type="file" name="image" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" name="update" class="btn btn-primary me-2 text-white">
                                                    Submit
                                                </button>
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