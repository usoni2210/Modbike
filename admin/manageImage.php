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
        <link href="../assets/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
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
                    /** @var Image[] $result */
                    $result = $conn->getAllImages();
                    if($result != null) {
                        ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Image Management</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered table-responsive-sm">
                                    <thead>
                                    <tr align="center">
                                        <th>Sno</th>
                                        <th>Image Name</th>
                                        <th>Email</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tbody align="center">
                                    <?php
                                        $count = 1;
                                        foreach ($result as $res){
                                            ?>
                                            <tr>
                                                <td><?php echo $count++;?></td>
                                                <td>
                                                        <u  data-toggle="popover" data-full="../images/modifiedBikes/<?php echo $res->getFileName(); ?>" data-height="300" data-width="400"><?php echo $res->getName(); ?></u>
                                                </td>
                                                <td><?php echo $res->getEmail(); ?></td>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <?php
                                                        if($res->is_disable){
                                                            ?>
                                                            <div class="col-md-3">
                                                                <a href="functions/showOrHideImage.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$res->getId()."&op=1"; ?>">
                                                                    <i class="fas fa-eye text-success" title="Enable"></i>
                                                                </a>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <a href="functions/showOrHideImage.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$res->getId()."&op=0"; ?>">
                                                                    <i class="fas fa-eye-slash text-danger" title="Disable"></i>
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-3">
                                                            <a href="functions/deleteImage.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$res->getId(); ?>">
                                                                <i class="fas fa-trash-alt" title="Delete"></i>
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
                    }else {
                        echo " <div class=\"col-12 text-grey p-5\" style=\"font-size: 40px\" align=\"center\">
                                        No Image Found
                                    </div>";
                    }
                ?>
            </div>
        </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="../assets/fancybox/dist/jquery.fancybox.min.js" type="text/javascript"></script>
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