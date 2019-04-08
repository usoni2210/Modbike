<?php
    if(isset($_COOKIE['cookie_user']) && !empty($_COOKIE['cookie_user']) &&
        isset($_COOKIE['cookie_pass']) && !empty($_COOKIE['cookie_pass']) &&
        !isset($_SESSION['admin_id'])
    ) {
        $conn = new Connection();
        if(($id = $conn->validateAdmin($_COOKIE['cookie_user'], $_COOKIE['cookie_pass'])) != null) {
            $admin = $conn->getBasicDetails($id);
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $admin->getName();
            $_SESSION['admin_image'] = $admin->getImage();
        } else {
           deleteCookie();
        }
    }

    if(!isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == null){
        header("Location:/index.php");
    } else {
        $admin_id = $_SESSION['admin_id'];
        $admin_name = $_SESSION['admin_name'];
        $admin_image = $_SESSION['admin_image'];

        $conn = new Connection();
    }
?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-lg fa-tasks"></span>
            </button>
            <a class="navbar-brand" href="./"><span class="text-grey">Mod</span>Bike</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?php if($_SERVER['PHP_SELF'] == "/admin/index.php") echo " active"; ?>">
                    <a href="/admin/index.php"> <i class="menu-icon fa fa-lg fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="/index.php"><i class="menu-icon fa fa-lg fa-home"></i>WebSite </a>
                </li>
                <h3 class="menu-title">WORK PLACE</h3>
                <li class="menu-item-has-children dropdown<?php if($_SERVER['PHP_SELF'] == "/admin/addPart.php" || $_SERVER['PHP_SELF'] == "/admin/manageParts.php" || $_SERVER['PHP_SELF'] == "/admin/addPartSupport.php") echo " active"; ?>">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lg fa-wrench"></i>PARTS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-plus"></i><a href="/admin/addPart.php">Add Parts</a></li>
                        <li><i class="far fa-edit"></i><a href="/admin/manageParts.php">Manage Parts</a></li>
                        <li><i class="menu-icon fas fa-cog"></i><a href="/admin/addPartSupport.php">Bike Support</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown<?php if($_SERVER['PHP_SELF'] == "/admin/addShop.php" || $_SERVER['PHP_SELF'] == "/admin/manageShop.php" || $_SERVER['PHP_SELF'] == "/admin/addPartSales.php") echo " active"; ?>">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lg fa-warehouse"></i>SHOPS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-plus"></i><a href="/admin/addShop.php">Add Shop</a></li>
                        <li><i class="fa fa-edit"></i><a href="/admin/manageShop.php">Manage Shop</a></li>
                        <li><i class="fa fa-shopping-cart"></i><a href="/admin/addPartSales.php">Add Part Sales</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown <?php if($_SERVER['PHP_SELF'] == "/admin/addBikes.php" || $_SERVER['PHP_SELF'] == "/admin/manageBikes.php" || $_SERVER['PHP_SELF'] == "/admin/companyName.php") echo " active"; ?>">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lg fa-motorcycle"></i>BIKE</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-plus"></i><a href="/admin/addBikes.php">Add Bikes</a></li>
                        <li><i class="menu-icon fa fa-edit"></i><a href="/admin/manageBikes.php">Manage Bikes</a></li>
                        <li><i class="menu-icon fas fa-building"></i><a href="/admin/companyName.php">Bike Company</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown<?php if($_SERVER['PHP_SELF'] == "/admin/manageImage.php" || $_SERVER['PHP_SELF'] == "/admin/approveImage.php") echo " active"; ?>">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lg fa-images"></i>IMAGE</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-check"></i><a href="/admin/approveImage.php">Approve Image</a></li>
                        <li><i class="fas fa-edit"></i><a href="/admin/manageImage.php">Manage Image</a></li>
                    </ul>
                </li>
                
                <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                <li class="<?php if($_SERVER['PHP_SELF'] == "/admin/viewFeedback.php") echo " active"; ?>"><a href="/admin/viewFeedback.php"><i class="menu-icon fa fa-lg fa-comments"></i>FEEDBACK</a></li>
            </ul>
        </div>
    </nav>
</aside>