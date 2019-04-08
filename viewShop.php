<?php
    session_start();
    require_once "includes/Connection.php";
    if(count($_SESSION['cart'])<=0){
        header("location:/findParts.php");
    }
    $conn = new Connection();
?>
<html lang="en">
    <head>
        <title><?php echo WEBSITE_NAME." - Find Parts"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/logo.png" type="image/png" sizes="32x32">

        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css">
        <link href="assets/animate/animate.min.css" rel="stylesheet" type="text/css">
        <link href="assets/main.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            .dropdown-toggle::after{
                display: none; !important;
            }
        </style>
    </head>
    <body>
        <?php require_once "includes/header.php"?><br><br>
            <div class="container-fluid p-5" style="min-height: 62vh;"><?php
                include "admin/functions/responses.php";
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h2 class="text-center"><u>For All Selected Parts</u></h2>
                        </div>
                        <div class="card-body p-0">
                        <?php
                            $shoppes = $conn->getShopForParts($_SESSION['cart']);
                            if($shoppes != null) { ?>
                                <table class="table table-bordered table-responsive-sm table-hover table-striped">
                                    <thead class="text-center bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Contact no.</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                            $count = 1;
                                            foreach ($shoppes as $sid) {
                                                $shop = $conn->getShopInfo($sid); ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td>
                                                        <u data-toggle="popover"
                                                           data-full="../images/shop/<?php echo $shop['image']; ?>"
                                                           data-height="150"
                                                           data-width="200"><?php echo $shop['name']; ?></u>
                                                    </td>
                                                    <td><?php echo $shop['phone_no']; ?></td>
                                                    <td><?php echo $shop['addr_fline'] . "<br>" . $shop['addr_sline'] . "<br>" . $shop['city'] . ", " . $shop['state'] . " (" . $shop['pin_code'] . ")"; ?></td>
                                                </tr><?php
                                            }
                                        ?>
                                    </tbody>
                                </table><?php
                            } else {
                                echo "<div class='text-grey text-center bg-black-10 p-5'>No Shop Found For This Part</div>";
                            }
                        ?>
                        </div>
                    </div><?php
                }
        ?>
                <br><br>
                <h2 class="text-center"><u>For Individual Parts</u></h2>

                <?php
                    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        foreach ($_SESSION['cart'] as $id) {
                            /** @var Shop[] $shoppes */
                            $shoppes = $conn->getShopForPart($id);
                            $part = $conn->getPartBasicInfo($id);?>
                            <div class="card border-0">
                                <div class="card-header bg-white">
                                    <h5 class="text-center">
                                        <u data-toggle="popover" data-full="../images/parts/<?php echo $part['image']; ?>" data-height="150" data-width="200"><?php echo $part['name']; ?></u>
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <?php if($shoppes != null) { ?>
                                        <table class="table table-bordered table-responsive-sm table-hover table-striped">
                                            <thead class="text-center bg-dark text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Contact no.</th>
                                                <th>Address</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php
                                                $count = 1;
                                                foreach ($shoppes as $shop) { ?>
                                                    <tr>
                                                        <td><?php echo $count++; ?></td>
                                                        <td>
                                                            <u data-toggle="popover" data-full="../images/shop/<?php echo $shop->getImage(); ?>" data-height="150" data-width="200"><?php echo $shop->getName(); ?></u>
                                                        </td>
                                                        <td><?php echo $shop->getPhone(); ?></td>
                                                        <td><?php echo $shop->getAddrFline()."<br>".$shop->getAddrSline()."<br>".$shop->getCity().", ".$shop->getState()." (".$shop->getPinCode().")"; ?></td>
                                                    </tr><?php
                                                }
                                            ?>
                                            </tbody>
                                        </table><?php
                                    } else {
                                        echo "<div class='text-grey text-center bg-black-10 p-5'>No Shop Found For These Parts</div>";
                                    }
                                ?>
                                </div>
                            </div><br><br><?php
                        }
                    }
                ?>
                <br>
                <div class="text-center">
                    <a href="findParts.php" class="btn btn-dark btn-lg bg-black">Go Back</a>
                </div>
            </div>
        <?php require_once "includes/footer.php"?>

        <script src="assets/jquery.min.js" type="text/javascript"></script>
        <script src="assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function($) {
                $(".alert").fadeTo(1000, 500).slideUp(500, function(){
                    $("#success-alert").alert('close');
                });

                $('[data-toggle="popover"]').popover({
                    html: true,
                    placement: 'auto',
                    trigger: 'hover',
                    boundary: 'viewport',
                    content: function() {
                        let url = $(this).data('full');
                        let hei = $(this).data('height');
                        let wid = $(this).data('width');
                        return '<img src="' + url + '" height="' + hei + '" width="'+ wid +'" alt="Image">'
                    }
                });
            });
        </script>
    </body>
</html>
