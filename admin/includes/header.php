<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 position-static shadow">
    <!-- Topbar Title -->
    <div class="mr-3" style="font-size: 1.2em;">
        <b>Admin Panel</b>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Messages -->
        <li class="nav-item position-relative no-arrow mx-1">
            <a class="nav-link mt-2" href="/admin/viewFeedback.php">
                <i class="fa fa-lg fa-envelope fa-fw"></i>
                <?php
                    $count = $conn->getUnreadFeedbackCount();
                    if($count != 0)
                        echo "<span class='badge badge-danger badge-counter'>".$count."</span>"
                ?>
            </a>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $admin_name; ?></span>
                <img class="img-profile rounded-circle" src="../images/admin/<?php echo $admin_image; ?>" alt="image">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/admin/userProfile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/admin/logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->