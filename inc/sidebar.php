<div class="col-lg-4">
    <div class="blog_right_sidebar">
        <aside class="single_sidebar_widget popular_post_widget">
            <h3 class="widget_title mb-3">Top Agents</h3>
            <?php
                $i=0;
                $statement = $pdo->prepare("SELECT * FROM agents WHERE status = 1 LIMIT 3");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) { $i++; ?>
                <div class="media post_item">
                    <img src="assets/img/agents/a1.png" class="img-fluid w-25" alt="post">
                    <div class="media-body">
                        <a href="#">
                            <h3><?php echo $row['name'] ?></h3>
                        </a>
                        <p><?php echo $row['email'] ?></p>
                        <p>
                            <a href="tel:+25<?php echo $row['phone'] ?>">
                                <b><?php echo $row['phone'] ?></b>
                            </a>
                        </p>
                    </div>
                </div>
            <?php } ?>
            <div class="br"></div>
        </aside>
        <aside class="single_sidebar_widget popular_post_widget">
            <h3 class="widget_title mb-3">Popular Properties</h3>
            <?php
                $i=0;
                $statement = $pdo->prepare("SELECT * FROM properties ORDER BY views DESC LIMIT 3");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) { $i++; ?>
                <div class="media post_item">
                    <img src="./admin/assets/uploads/properties/<?php echo $row['featured_photo']; ?>" style="width: 100px;">
                    <div class="media-body">
                        <a href="property-show.php?id=<?php echo $row['id'] ?>">
                            <h3><?php echo $row['name'] ?></h3>
                        </a>
                        <p><?php echo $row['created_at'] ?></p>
                    </div>
                </div>
            <?php } ?>
            <div class="br"></div>
        </aside>
        <aside class="single_sidebar_widget ads_widget">
            <a href="#">
                <img class="img-fluid" src="assets/img/add.jpg" alt="">
            </a>
            <div class="br"></div>
        </aside>
        <!-- <aside class="single_sidebar_widget post_category_widget">
            <h4 class="widget_title">Post Catgories</h4>
            <ul class="list cat-list">
                <li>
                    <a href="#" class="d-flex justify-content-between">
                        <p>Technology</p>
                        <p>37</p>
                    </a>
                </li>
            </ul>
            <div class="br"></div>
        </aside>
        <aside class="single-sidebar-widget tag_cloud_widget">
            <h4 class="widget_title">Tag Clouds</h4>
            <ul class="list">
                <li>
                    <a href="#">Technology</a>
                </li>
            </ul>
        </aside -->>
    </div>
</div>