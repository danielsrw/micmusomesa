<?php
    include('inc/css.php');
    include('controllers/SettingsController.php');

    $statement = $pdo->prepare("SELECT * FROM social_media");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        if($row['name'] == 'Facebook') {
            $facebook = $row['url'];
        }

        if($row['name'] == 'Twitter') {
            $twitter = $row['url'];
        }

        if($row['name'] == 'Instagram') {
            $instagram = $row['url'];
        }

        if($row['name'] == 'Youtube') {
            $youtube = $row['url'];
        }

        if($row['name'] == 'Whatsapp') {
            $whatsapp = $row['url'];
        }

        if($row['name'] == 'LinkedIn') {
            $linkedin = $row['url'];
        }
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
                                <h5>Social Media</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample" action="#" method="POST">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Facebook</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="facebook" class="form-control mt-3"  value="<?php echo $facebook ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Twitter</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="twitter" class="form-control mt-3" value="<?php echo $twitter ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Instgram</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="instagram" class="form-control mt-3" value="<?php echo $instagram ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Youtube</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="youtube" class="form-control mt-3" value="<?php echo $youtube ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Whatsapp</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="whatsapp" class="form-control mt-3" value="<?php echo $whatsapp ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">LinkedIn</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="linkedin" class="form-control mt-3" value="<?php echo $linkedin ?>" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="submit" name="updateSocialMedia" class="btn btn-primary me-2 text-white">
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
    </div>

    <?php include('inc/js.php') ?>