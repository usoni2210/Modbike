<?php
    require_once "../includes/Connection.php";
    require_once "../includes/function.php";
    session_start();

    if(isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['password']) && !empty($_POST['password']))
	{
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $conn = new Connection();
        if(($id = $conn->validateAdmin($user, $pass)) != null)
		{
            $admin = $conn->getBasicDetails($id);
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $admin->getName();
            $_SESSION['admin_image'] = $admin->getImage();
            if(isset($_POST['remember'])){
                setCookies($user, $pass);
            } else{
                deleteCookie();
            }
        } else {
            header("location: /index.php?warn=Username and Password not Match");
            die();
        }
    }
?>
<html lang="en">
	<head>
		<title><?php echo WEBSITE_NAME." - Admin Dashboard"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../images/logo.png" type="image/png" sizes="32x32">

        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css">
        <link href="../assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/animate/animate.min.css" rel="stylesheet" type="text/css">
        <link href="assets/main.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .dashboard-stat {
                display: block;
                padding: 30px 15px;
                text-align: right;
                position: relative;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                color: #ffffff;
            }

            .dashboard-stat .number {
                font-size: 28px;
                display: block;
            }

            .dashboard-stat .bg-icon {
                position: absolute;
                font-size: 80px;
                opacity: 0.4;
                left: 5px;
                bottom: 5px;
            }

            .dashboard-stat:hover {
                background-color: black;
                color: #ffffff;
            }

            @media (max-width: 768px) {
                .dashboard-stat {
                    margin-bottom: 10px;
                }
            }

            .dropdown-toggle::after{
                display: none; !important;
            }
        </style>
    </head>
	<body>
        <?php include "includes/leftbar.php"; ?>

        <div id="right-panel" class="right-panel">
            <?php include "includes/header.php"; ?>
            <div class="container-fluid">
                <div class="row">
                    <?php
                        $newImages = $conn->countNewImages();
                        $totalParts = $conn->countTotalParts();
                        $totalShop = $conn->countTotalShops();
                        $totalBike = $conn->countTotalBikes();
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a class="dashboard-stat bg-primary" href="approveImage.php">
                            <span class="number"><?php echo htmlentities($newImages);?></span>
                            <span class="name">New Images</span>
                            <span class="bg-icon"><i class="fa fa-images"></i></span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a class="dashboard-stat bg-danger" href="manageParts.php">
                            <span class="number"><?php echo htmlentities($totalParts);?></span>
                            <span class="name">Total Parts</span>
                            <span class="bg-icon"><i class="fa fa-cog"></i></span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a class="dashboard-stat bg-success" href="manageShop.php">
                            <span class="number"><?php echo htmlentities($totalShop);?></span>
                            <span class="name">Total Shop</span>
                            <span class="bg-icon"><i class="fa fa-building"></i></span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a class="dashboard-stat bg-warning" href="manageBikes.php">
                            <span class="number"><?php echo htmlentities($totalBike);?></span>
                            <span class="name">Total Bikes</span>
                            <span class="bg-icon"><i class="fa fa-motorcycle"></i></span>
                        </a>
                    </div>
                </div>
            </div>
         </div>

		<script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
        </script>
	</body>
</html>

