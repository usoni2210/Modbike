<?php
    include "../includes/Connection.php";
    session_start();
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
                <?php
                    include "functions/responses.php";
                    $conn = new Connection();
                    /** @var mysqli_result[] $result */
                    $result = $conn->getAllBike();
                    if($result != null){
                        ?>
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bike List</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-responsive-md">
                                <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Company Name</th>
                                    <th>Bike Name</th>
                                    <th>Type</th>
                                    <th>Release Year</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody align="center">
                                <?php
                                    $count = 1;
                                    foreach ($result as $res){
                                        ?>
                                        <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $res['comp_name']; ?></td>
                                        <td><?php echo $res['name'] ?></td>
                                        <td><?php echo $res['type']; ?></td>
                                        <td><?php echo $res['release_year']; ?><td>
                                            <div class="row justify-content-center">
                                                <!--div class="col-md-3">
                                                    <a href="">
                                                        <i class="fas fa-edit text-success" title="Edit"></i>
                                                    </a>
                                                </div-->
                                                <div class="col-md-3">
                                                    <a href="functions/deleteBike.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$res['id']; ?>">
                                                        <i class="fas fa-trash-alt text-danger" title="Delete"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        </tr><?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        </div><?php
                    } else {
                        echo " <div class=\"col-12 text-grey p-5\" style=\"font-size: 40px\" align=\"center\">
                                        No Bike Found
                                    </div>";
                    }
                ?>
            </div>
        </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript1.5">

        </script>
    </body>
</html>