<?php
    include('inc/css.php');
    require_once('controllers/SettingsController.php');
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
                                <h5>Add District</h5>
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="view-districts.php" class="btn btn-primary text-white me-0">
                                                <i class="icon-eye"></i> View District
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="#" method="POST">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control" placeholder="Property Name">
                                            </div>
                                        </div>
                                        <button type="submit" name="createDistrict" class="btn btn-primary me-2 text-white">
                                            Add District
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

    <?php include('inc/js.php') ?>