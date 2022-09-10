<?php
    include('inc/css.php');
    include('controllers/SettingsController.php');

    if(!isset($_REQUEST['id'])) {
            header('location: logout.php');
            exit;
        } else {
            // Check the id is valid or not
            $statement = $pdo->prepare("SELECT * FROM settings WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $total = $statement->rowCount();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if( $total == 0 ) {
                header('location: logout.php');
                exit;
            }
        }

        $statement = $pdo->prepare("SELECT * FROM settings WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $aboutImage = $row['aboutImage'];
            $alt = $row['alt'];
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
                                <h5>Background</h5>
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom mb-3">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="view-background-about.php" class="btn btn-primary text-white me-0">
                                                <i class="icon-arrow-left"></i> Go Back
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="table-responsive col-sm-6">
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="forms-sample" action="#" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Current Image</label>
                                                        <div class="col-sm-9">
                                                            <input type="hidden" name="current_photo" value="./assets/uploads/backgrounds/<?php echo $row['aboutImage']; ?>">
                                                            <img src="./assets/uploads/backgrounds/<?php echo $row['aboutImage']; ?>" style="width: 100px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">New Image</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="aboutImage" class="form-control mt-2">
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="update-about-image" class="btn btn-primary me-2 text-white">
                                                        Update Image
                                                    </button>
                                                    <button class="btn" data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/js.php') ?>