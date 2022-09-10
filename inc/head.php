<style>
    #logo img {
          width: 100px;
    }
</style>

<header class="default-header">
    <div class="menutop-wrap">
        <div class="menu-top container">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="socials">
                    <?php
                        $statement = $pdo->prepare("SELECT * FROM social_media");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) { ?>
                        <?php if($row['url'] != ''): ?>
                            <li>
                                    <a href="<?php echo $row['url']; ?>">
                                         <i class="<?php echo $row['icon']; ?>"></i>
                                    </a>
                            </li>
                        <?php endif; ?>
                    <?php } ?>
                </ul>
                <ul class="list">
                    <li>
                        <a href="tel:+250790140002" style="color: white;">
                            <i class="lnr lnr-phone" style="color: white;"></i>
                            +250 790 140 002
                        </a>
                    </li>
                    <li>
                        <a href="mail:info@micmusomesa.com" style="color: white;">
                            <i class="lnr lnr-envelope" style="color: white;"></i>
                            info@micmusomesa.com
                        </a>
                    </li>
                    <?php
                        if(isset($_SESSION['customer'])) { ?>
                                <li>
                                    <a href="agent-profile.php">
                                            <i class="fa fa-user"></i> 
                                            Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php">
                                            <i class="fa fa-sign-out"></i> 
                                            Logout
                                    </a>
                                </li>
                        <?php } else { ?>
                            <!-- <li>
                                    <a href="account.php">
                                        <i class="fa fa-sign-in"></i>
                                        Create account
                                    </a>
                            </li> -->
                        <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-menu">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.php">
                        <img src="assets/img/logo.png" alt="" title="" />
                    </a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li>
                            <a href="home.php">home</a>
                        </li>
                        <li>
                            <a href="about.php">about us</a>
                        </li>
                        <li class="menu-has-children">
                            <a href="">
                                projects
                            </a>
                            <ul>
                                <?php
                                      $i=0;
                                      $statement = $pdo->prepare("SELECT * FROM projects WHERE status = 1");
                                      $statement->execute();
                                      $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                      foreach ($result as $row) { $i++; ?>
                                    <li class="menu-has-children">
                                        <a href="#!"><?php echo $row['category'] ?></a>
                                        <ul>
                                            <li>
                                                <a href="project-show.php?id=<?php echo $row['id'] ?>">
                                                    <?php echo $row['name'] ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="menu-has-children">
                            <a href="">
                                properties
                            </a>
                            <ul>
                                <li>
                                    <a href="property-sale.php">For Sale</a>
                                </li>
                                <li>
                                    <a href="property-rent.php">For Rent</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-has-children">
                            <a href="#">
                                Services
                            </a>
                            <ul>
                                <?php
                                    $i=0;
                                    $statement = $pdo->prepare("SELECT * FROM services WHERE status = 1 ORDER BY id DESC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($result as $row) { $i++; ?>
                                    <li>
                                        <a href="service-show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="team.php">team</a>
                        </li>
                        <li>
                            <a href="testimony.php">Testimony</a>
                        </li>
                        <li>
                            <a href="contact.php">contact us</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>