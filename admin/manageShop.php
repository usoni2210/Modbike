<?php
    require_once "../includes/config.php";
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
                    /** @var Shop[] $result */
                    $result = $conn->getAllShop();
                    if($result != null){
                        ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Shoppes List</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered table-responsive-md">
                                    <thead>
                                        <tr align="center">
                                            <th>Sno</th>
                                            <th>Owner Name</th>
                                            <th>Shop Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
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
                                            <td><?php echo $res->getOwner() ?></td>
                                            <td>
                                                <u data-toggle="popover" data-full="../images/shop/<?php echo $res->getImage() ?>" data-height="300" data-width="400"><?php echo $res->getName() ?></u>

                                            </td>
                                            <td><?php echo $res->getPhone(); ?></td>
                                            <td><?php echo $res->getAddrFline()."<br>"
                                                    .$res->getAddrSline()."<br>"
                                                    .$res->getCity().", ".$res->getState()."<br>"
                                                    ."Pin Code: ".$res->getPinCode(); ?></td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <!--div class="col-md-3">
                                                        <a href="">
                                                            <i class="fas fa-edit text-success" title="Edit"></i>
                                                        </a>
                                                    </div -->
                                                    <div class="col-md-3">
                                                        <a href="functions/deleteShop.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$res->getId(); ?>">
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
                                        No Shop Found
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
            $(document).ready(function() {
                // grab all thumbnails and add bootstrap popovers
                // https://getbootstrap.com/javascript/#popovers
                $('[data-toggle="popover"]').popover({
                    container: 'body',
                    html: true,
                    placement: 'auto',
                    trigger: 'hover',
                    content: function() {
                        // get the url for the full size img
                        let url = $(this).data('full');
                        let hei = $(this).data('height');
                        let wid = $(this).data('width');
                        return '<img src="' + url + '" height="' + hei + '" width="'+ wid +'">'
                    }
                });
            });
        </script>
    </body>
</html>

