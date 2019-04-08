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
                <?php include "functions/responses.php"; ?>
                <div class="row">
                    <?php
                        $con = new Connection();
                        /** @var Image[] $images */
                        $images = $con->getNewlyUploadedImages();
                        if($images == null){
                            echo "<div class='col-12 text-center p-5 text-grey' style='font-size: 2.5vw;'>No New Images</div>";
                        } else {
                            foreach($images as $image){
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                                    <div class="card">
                                        <a class="fancybox" href="/images/modifiedBikes/<?php echo $image->getFileName(); ?>" data-fancybox="images" data-caption="<?php echo $image->getName()."<br>".$image->getEmail(); ?>">
                                            <img class="card-img-top" src="/images/modifiedBikes/<?php echo $image->getFileName(); ?>" alt="Card image cap">
                                        </a>
                                        <div class="card-body p-1">
                                            <div class="row text-center">
                                                <div class="col">
                                                    <a href="functions/allowImage.php?<?php echo "id=".$image->getId()."&q=".$_SERVER['PHP_SELF']; ?>" class="btn"><i class="fas fa-check fa-2x text-success" title="Approve Image"></i></a>
                                                </div>
                                                <div class="col">
                                                    <a href="functions/deleteImage.php?<?php echo "id=".$image->getId()."&q=".$_SERVER['PHP_SELF']; ?>" class="btn"><i class="fas fa-times fa-2x text-danger" title="Reject Image"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                </div>
            </div>
        </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="../assets/fancybox/dist/jquery.fancybox.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript1.5">
            $('[data-fancybox="images"]').fancybox({
                afterLoad : function(instance, current) {
                    let pixelRatio = window.devicePixelRatio || 1;

                    if ( pixelRatio > 1.5 ) {
                        current.width  = current.width  / pixelRatio;
                        current.height = current.height / pixelRatio;
                    }
                }
            });
        </script>
    </body>
</html>