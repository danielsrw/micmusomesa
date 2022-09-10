<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="dashboard.php">
                <img src="assets/images/logo.svg" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="dashboard.php">
                <img src="assets/images/logo-mini.svg" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">
                    Good Morning, 
                    <span class="text-black fw-bold text-capitalize"><?php echo $_SESSION['user']['full_name']; ?></span>
                </h1>
                <?php include('message.php') ?>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="./assets/uploads/profile/<?php echo $_SESSION['user']['photo']; ?>" alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle w-25" src="./assets/uploads/profile/<?php echo $_SESSION['user']['photo']; ?>" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold text-uppercase"><?php echo $_SESSION['user']['full_name']; ?></p>
                        <p class="fw-light text-muted mb-0"><?php echo $_SESSION['user']['email']; ?></p>
                    </div>
                    <a href="profile.php" class="dropdown-item">
                        <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> 
                        My Profile 
                    </a>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> 
                        Sign Out
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" action="#" method="POST">
                    <p class="mb-5">
                        Are you sure you want to logout?
                    </p>
                    <a href="logout.php" class="btn btn-primary me-2 text-white">
                        Yes
                    </a>
                    <button class="btn" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>