<?php
    include('inc/css.php');

    $statement = $pdo->prepare("SELECT * FROM properties");
    $statement->execute();
    $total_properties = $statement->rowCount();

    $statement = $pdo->prepare("SELECT * FROM agents");
    $statement->execute();
    $total_agents = $statement->rowCount();

    $statement = $pdo->prepare("SELECT * FROM teams");
    $statement->execute();
    $total_team = $statement->rowCount();

    $statement = $pdo->prepare("SELECT * FROM contacts");
    $statement->execute();
    $total_contacts = $statement->rowCount();

    $statement = $pdo->prepare("SELECT * FROM projects");
    $statement->execute();
    $total_projects = $statement->rowCount();

    $statement = $pdo->prepare("SELECT * FROM testimonies");
    $statement->execute();
    $total_testimony = $statement->rowCount();
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
                                <h5>Dashboard</h5>
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

                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div class="text-center">
                                                        <p class="statistics-title">Properties</p>
                                                        <h3 class="rate-percentage"><?php echo $total_properties; ?></h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="statistics-title">Agents</p>
                                                        <h3 class="rate-percentage"><?php echo $total_agents; ?></h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="statistics-title">Team Members</p>
                                                        <h3 class="rate-percentage"><?php echo $total_team; ?></h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="statistics-title">Contacts</p>
                                                        <h3 class="rate-percentage"><?php echo $total_contacts; ?></h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="statistics-title">Projects</p>
                                                        <h3 class="rate-percentage"><?php echo $total_projects; ?></h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="statistics-title">Testimonies</p>
                                                        <h3 class="rate-percentage"><?php echo $total_testimony; ?></h3>
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
        </div>
    </div>

    <?php include('inc/js.php') ?>