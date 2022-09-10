<?php
    include('inc/css.php');
    require_once('controllers/PropertyController.php');
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
                                <h5>Property</h5>
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="add-property.php" class="btn btn-primary text-white me-0">
                                                <i class="icon-plus"></i> Add Property
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Address</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=0;
                                        $statement = $pdo->prepare("SELECT * FROM properties ORDER BY id DESC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($result as $row) { $i++; ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td class="py-1">
                                                <img src="./assets/uploads/properties/<?php echo $row['featured_photo']; ?>">
                                            </td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td>
                                                <a href="edit-property.php?id=<?php echo $row['id']; ?>">
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
                                                            Are you sure you want to delete this property (<?php echo $row['name'] ?>)
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                          Close
                                                        </button>
                                                        <a class="btn btn-danger" href="delete-property.php?id=<?php echo $row['id']; ?>">Delete</a>
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

    <?php include('inc/js.php') ?>