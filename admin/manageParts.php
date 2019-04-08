<?php
    require_once "../includes/Connection.php";
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
                <?php include "functions/responses.php"; ?>
                <nav class="nav nav-tabs" id="nav-tab" role="navigation">
                        <a class="nav-item nav-link active" id="nav-taillight-tab" data-toggle="tab" href="#nav-taillight" role="tab" aria-controls="nav-taillight" aria-selected="true">Tail Light</a>
                        <a class="nav-item nav-link" id="nav-headlight-tab" data-toggle="tab" href="#nav-headlight" role="tab" aria-controls="nav-headlight" aria-selected="false">Head Light</a>
                        <a class="nav-item nav-link" id="nav-seat-tab" data-toggle="tab" href="#nav-seat" role="tab" aria-controls="nav-seat" aria-selected="false">Seat</a>
                        <a class="nav-item nav-link" id="nav-silence-tab" data-toggle="tab" href="#nav-silencer" role="tab" aria-controls="nav-silencer" aria-selected="false">Silencer</a>
                        <a class="nav-item nav-link" id="nav-tank-tab" data-toggle="tab" href="#nav-tank" role="tab" aria-controls="nav-tank" aria-selected="false">Fuel Tank</a>
                </nav>
                <div class="tab-content bg-white overflow-auto" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-taillight" role="tabpanel" aria-labelledby="nav-taillight-tab" style="min-height: 70vh;">
                        <?php
                            $tails = $conn->getTailLightList();
                            if($tails != null) { ?>
                                <table class="table table-responsive-lg table-bordered table-hover">
                                    <thead class="text-center bg-dark text-white">
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Material</th>
                                        <th>Dimension</th>
                                        <th>Colour</th>
                                        <th>Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <?php
                                        $count = 1;
                                        foreach($tails as $tail) { ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td>
                                                    <u data-toggle="popover" data-full="../images/parts/<?php echo $tail['image']; ?>" data-height="300" data-weight="400"><?php echo $tail['name']; ?></u>
                                                </td>
                                                <td><?php echo $tail['price']; ?></td>
                                                <td><?php echo $tail['material']; ?></td>
                                                <td><?php echo $tail['dimension']; ?></td>
                                                <td><?php echo $tail['color']; ?></td>
                                                <td>
                                                    <a href="functions/deletePart.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$tail['id']; ?>">
                                                        <i class="fas fa-trash-alt text-danger" title="Delete"></i>
                                                    </a>
                                                </td>
                                            </tr><?php
                                        }
                                    ?>
                                    </tbody>
                                </table><?php
                            } else {
                                echo "<h2 class='text-center p-5 font-weight-bold text-grey'>No Tail Light Found</h2>";
                            }
                        ?>
                    </div>
                    <div class="tab-pane fade bg-white" id="nav-headlight" role="tabpanel" aria-labelledby="nav-headlight-tab" style="min-height: 70vh;">
                        <?php
                            $heads = $conn->getHeadLightList();
                            if($heads != null) { ?>
                                <table class="table table-responsive-lg table-bordered table-hover">
                                <thead class="text-center bg-dark text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Material</th>
                                    <th>Dimension</th>
                                    <th>Colour</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                    $count = 1;
                                    foreach($heads as $head) { ?>
                                        <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <u  data-toggle="popover" data-full="../images/parts/<?php echo $head['image']; ?>" data-height="300" data-weight="400"><?php echo $head['name']; ?></u>
                                        </td>
                                        <td><?php echo $head['price']; ?></td>
                                        <td><?php echo $head['material']; ?></td>
                                        <td><?php echo $head['dimension']; ?></td>
                                        <td><?php echo $head['color']; ?></td>
                                        <td>
                                            <a href="functions/deletePart.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$head['id']; ?>">
                                                <i class="fas fa-trash-alt text-danger" title="Delete"></i>
                                            </a>
                                        </td>
                                        </tr><?php
                                    }
                                ?>
                                </tbody>
                                </table><?php
                            } else {
                                echo "<h2 class='text-center p-5 font-weight-bold text-grey'>No Head Light Found</h2>";
                            }
                        ?>
                    </div>
                    <div class="tab-pane fade bg-white" id="nav-seat" role="tabpanel" aria-labelledby="nav-seat-tab" style="min-height: 70vh;">
                        <?php
                            $seats = $conn->getSeatList();
                            if($seats != null) { ?>
                                <table class="table table-responsive-lg table-bordered table-hover">
                                <thead class="text-center bg-dark text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Material</th>
                                    <th>Color</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                    $count = 1;
                                    foreach($seats as $seat) { ?>
                                        <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <u data-toggle="popover" data-full="../images/parts/<?php echo $seat['image'] ?>" data-height="300" data-weight="400" ><?php echo $seat['name']; ?></u>
                                        </td>
                                        <td><?php echo $seat['price']; ?></td>
                                        <td><?php echo $seat['type']; ?></td>
                                        <td><?php echo $seat['material']; ?></td>
                                        <td><?php echo $seat['color']; ?></td>
                                        <td>
                                            <a href="functions/deletePart.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$seat['id']; ?>">
                                                <i class="fas fa-trash-alt text-danger" title="Delete"></i>
                                            </a>
                                        </td>
                                        </tr><?php
                                    }
                                ?>
                                </tbody>
                                </table><?php
                            } else {
                                echo "<h2 class='text-center p-5 font-weight-bold text-grey'>No Seat Found</h2>";
                            }
                        ?>
                    </div>
                    <div class="tab-pane fade bg-white" id="nav-silencer" role="tabpanel" aria-labelledby="nav-silence-tab" style="min-height: 70vh;">
                        <?php
                            $silencers = $conn->getSilencerList();
                            if($silencers != null) { ?>
                                <table class="table table-responsive-lg table-bordered table-hover">
                                <thead class="text-center bg-dark text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Material</th>
                                    <th>Dimension</th>
                                    <th>Weight</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                    $count = 1;
                                    foreach($silencers as $silencer) { ?>
                                        <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <u data-toggle="popover" data-full="../images/parts/<?php echo $silencer['image'] ?>" data-height="300" data-width="400"><?php echo $silencer['name']; ?></u>
                                        </td>
                                        <td><?php echo $silencer['price']; ?></td>
                                        <td><?php echo $silencer['material']; ?></td>
                                        <td><?php echo $silencer['dimension']; ?></td>
                                        <td><?php echo $silencer['weight']." Gram"; ?></td>
                                        <td>
                                            <a href="functions/deletePart.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$silencer['id']; ?>">
                                                <i class="fas fa-trash-alt text-danger" title="Delete"></i>
                                            </a>
                                        </td>
                                        </tr><?php
                                    }
                                ?>
                                </tbody>
                                </table><?php
                            } else {
                                echo "<h2 class='text-center p-5 font-weight-bold text-grey'>No Silencer Found</h2>";
                            }
                        ?>
                    </div>
                    <div class="tab-pane fade bg-white" id="nav-tank" role="tabpanel" aria-labelledby="nav-tank-tab" style="min-height: 70vh;">
                        <?php
                            $tanks = $conn->getFuelTankList();
                            if($tanks != null) { ?>
                                <table class="table table-responsive-lg table-bordered table-hover">
                                <thead class="text-center bg-dark text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Capacity</th>
                                    <th>Colour</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                    $count = 1;
                                    foreach($tanks as $tank) { ?>
                                        <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <u data-toggle="popover" data-full="../images/parts/<?php echo $tank['image'] ?>" data-height="300" data-width="400"><?php echo $tank['name']; ?></u>
                                        </td>
                                        <td><?php echo $tank['price']; ?></td>
                                        <td><?php echo $tank['capacity']; ?></td>
                                        <td><?php echo $tank['color']; ?></td>
                                        <td>
                                            <a href="functions/deletePart.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$tank['id']; ?>">
                                                <i class="fas fa-trash-alt text-danger" title="Delete"></i>
                                            </a>
                                        </td>
                                        </tr><?php
                                    }
                                ?>
                                </tbody>
                                </table><?php
                            } else {
                                echo "<h2 class='text-center p-5 font-weight-bold text-grey'>No Fuel Tank Found</h2>";
                            }
                        ?>
                    </div>
                </div>
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

