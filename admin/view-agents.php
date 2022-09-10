<?php
    include('inc/css.php')
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
                                <h5>Agents</h5>
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

                                <div class="table-responsive">
                                    <table class="table table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i=0;
                                                $statement = $pdo->prepare("SELECT * FROM agents ORDER BY id DESC");
                                                $statement->execute();
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($result as $row) { $i++; ?>
                                                <tr>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td>
                                                        <img src="./assets/uploads/agents/<?php echo $row['image']; ?>">
                                                    </td>
                                                    <td><?php echo $row['address'] ?></td>
                                                    <td>
                                                        <?php if ($row['status'] == 1): ?>
                                                            <a href="#">
                                                                <i class="mdi mdi-thumb-up menu-icon" style="color: green;"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="#">
                                                                <i class="mdi mdi-thumb-down menu-icon" style="color: red;"></i>
                                                            </a>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit-agent.php?id=<?php echo $row['id']; ?>">
                                                            <span class="btn btn-sm btn-primary text-white">Edit</span>
                                                        </a>
                                                        <span data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id']; ?>" class="btn btn-sm btn-danger text-white">Delete</span>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="delete<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <p>
                                                                    Are you sure you want to delete this agent (<?php echo $row['name'] ?>)
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                  Close
                                                                </button>
                                                                <a class="btn btn-danger" href="delete-agent.php?id=<?php echo $row['id']; ?>">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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