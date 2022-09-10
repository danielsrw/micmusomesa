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
                                <h5>Add Property</h5>
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="view-property.php" class="btn btn-primary text-white me-0">
                                                <i class="icon-eye"></i> View Properties
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Property</h4>
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
                                                                <span class="input-group-text">MM</span>
                                                            </div>
                                                            <input type="hidden" name="code" value="MM" />
                                                            <input type="text" name="name" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control mt-2" name="status">
                                                            <option>Choose Status</option>
                                                            <option value="Rent">Rent</option>
                                                            <option value="Sale">Sale</option>
                                                            <option value="Rented">Rented</option>
                                                            <option value="Sold">Sold</option>
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
                                                                $i=0;
                                                                $statement = $pdo->prepare("SELECT * FROM agents WHERE status = 1 ORDER BY id DESC");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach ($result as $row) { $i++; ?>
                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                            <?php } ?>
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
                                                                $i=0;
                                                                $statement = $pdo->prepare("SELECT * FROM types WHERE status = 1 ORDER BY id DESC");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach ($result as $row) { $i++; ?>
                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                            <?php } ?>
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
                                                        <input type="number" name="room" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Bedroom(s)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="bedroom" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Bathroom(s)</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="bathroom" class="form-control mt-2" />
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
                                                                <option value="Negotiable">Negotiable</option>
                                                                <option value="Not Negotiable">Not Negotiable</option>
                                                            </select>
                                                            <input type="number" name="price" class="form-control" />
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
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="number" name="area" class="form-control mt-2" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text mt-2">SQM</span>
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
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="number" name="builtup_area" class="form-control mt-2" />
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text mt-2">SQM</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Year Built</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="year" class="form-control mt-2" />
                                                        <p style="color: green">
                                                            You can leave this empty if you want
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Video</label>
                                                    <div class="col-sm-9">
                                                        <input type="url" name="video" class="form-control mt-2" />
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
                                                    <div class="col-sm-9">
                                                        <input type="text" name="address" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Neighborhood</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="neighborhood" class="form-control mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Country</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control mt-2" name="country">
                                                            <option value="Rwanda">Rwanda</option>
                                                        </select>
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
                                                                $i=0;
                                                                $statement = $pdo->prepare("SELECT * FROM districts ORDER BY id DESC");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach ($result as $row) { $i++; ?>
                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Sector</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="sector" class="form-control mt-2" placeholder="Sector" />
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
                                                                $i=0;
                                                                $statement = $pdo->prepare("SELECT * FROM features WHERE status = 1 ORDER BY id DESC");
                                                                $statement->execute();
                                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach ($result as $row) { $i++; ?>
                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Postal Code</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="zip" class="form-control mt-2" />
                                                        <p style="color: green">
                                                            You can leave this empty if you want
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Featured Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="featured_photo" class="form-control mt-2">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Other Images</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="photo[]" class="form-control mt-2" multiple="multiple">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control mt-2" rows="5" name="description" style="height: 200px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="hidden" name="views" value="0">
                                                <button type="submit" name="createProperty" class="btn btn-primary me-2">Submit</button>
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