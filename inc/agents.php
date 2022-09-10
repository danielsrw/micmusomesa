<style>
    .author_img {
        width: 120px;
    }
</style>

<?php
    $i=0;
    $statement = $pdo->prepare("SELECT * FROM agents");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) { $i++; ?>
    <div class="col-lg-4" style="padding: 20px;">
        <div class="blog_right_sidebar">
            <div class="single_sidebar_widget author_widget">
                <img class="author_img rounded-circle" src="./admin/assets/uploads/agents/<?php echo $row['image'] ?>" alt="">
                <h4><?php echo $row['name'] ?></h4>
                <div class="d-flex justify-content-center">
                    <i class="fa fa-star p-1"></i>
                    <i class="fa fa-star p-1"></i>
                    <i class="fa fa-star p-1"></i>
                    <i class="fa fa-star p-1"></i>
                    <i class="fa fa-star-o p-1"></i>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p>Property</p>
                    <span><b>20</b></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p>Email</p>
                    <span><b><?php echo $row['email']; ?></b></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p>Phone</p>
                    <span><b><?php echo $row['phone'] ?></b></span>
                </div>
                <div class="br"></div>
                <a href="agent-profile.php?id=<?php echo $row['id'] ?>">
                    <h3 class="widget_title">View Profile</h3>
                </a>
            </div>
        </div>
    </div>
<?php } ?>