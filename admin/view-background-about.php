<?php
    include('inc/css.php');
    include('controllers/SettingsController.php');
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
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive col-sm-8">
                                    <table class="table table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i=0;
                                                $statement = $pdo->prepare("SELECT * FROM settings");
                                                $statement->execute();
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($result as $row) { $i++; ?>
                                                <tr>
                                                    <td>
                                                        <img src="./assets/uploads/backgrounds/<?php echo $row['aboutImage']; ?>">
                                                    </td>
                                                    <td>
                                                        <a href="edit-background-about.php?id=<?php echo $row['id']; ?>">
                                                            <span class="btn btn-sm btn-primary text-white">
                                                                Change Background
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/js.php') ?>