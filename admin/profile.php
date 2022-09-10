<?php
    include('inc/css.php');
    require('controllers/ProfileController.php');
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
                                <h5>Profile</h5>
                                <div class="row">
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Update information</h4>
                                                <form class="forms-sample" method="POST" action="#">
                                                    <div class="form-group">
                                                        <label>Names</label>
                                                        <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <?php
                                                            if($_SESSION['user']['role'] == 'Super Admin') { ?>
                                                            <?php
                                                                $i=0;
                                                                $statement = $pdo->prepare("SELECT * FROM roles");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                                echo "<select name='role' class='form-control'>";

                                                                foreach ($result as $row) { $i++; ?>
                                                                    <option value="<?php echo $row['name'] ?>" <?php if($row['name'] == '1'){echo 'selected';} ?>><?php echo $row['name'] ?></option>
                                                                <?php }

                                                                echo "</select>";
                                                            ?>
                                                        <?php } else { ?>
                                                            <input type="text" class="form-control" name="role" value="<?php echo $role; ?>" disabled>
                                                            <span style="font-size: 12px; color: red;">You're not allowed to change this info</span>
                                                        <?php } ?>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary me-2 text-white" name="update-info">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Update image</h4>
                                                <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Old Profile image</label>
                                                        <br>
                                                        <img class="img-fluid mb-3" src="./assets/uploads/profile/<?php echo $photo; ?>" style="width: 100px;">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Profile image</label>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary me-2 text-white" name="update-image">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Update password</h4>
                                                <form class="forms-sample" action="" method="POST">
                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Type new password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" class="form-control" name="re_password" placeholder="Retype new password">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary me-2 text-white" name="update-password">Update</button>
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