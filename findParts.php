<?php
    session_start();
    require_once "includes/Connection.php";
    if(isset($_POST['startFind'])){
        $_SESSION['bike'] = $_POST['bike'];
        $_SESSION['category'] = $_POST['category'];
    }
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
            fieldset.scheduler-border {
                border: 3px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow:  0 0 0 0 #000;
                box-shadow:  0 0 0 0 #000;
            }

            legend.scheduler-border {
                width: inherit ;
                padding: 0 10px;
                border-bottom: none;
            }
            .dropdown-toggle::after{
                display: none; !important;
            }
        </style>
    </head>
	<body>
        <?php require_once "includes/header.php"?><br>
        <div class="container-fluid p-5" style="min-height: 64.5vh;">
            <?php include "admin/functions/responses.php"; ?>
            <div class="">
                <form action="findParts.php" method="post">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border font-weight-bold">SEARCH</legend>
                            <div class="row pt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="company" class="form-control" id="company" title="Please Select one option" required >
                                            <?php
                                                $conn = new Connection();
                                                /** @var Company[] $company */
                                                $company = $conn->getCompanyList();
                                                if($company != null){
                                                    foreach($company as $comp){
                                                        echo "<option value='".$comp->getId()."'>".$comp->getName()."</option>";
                                                    }
                                                    echo "<option value='' selected>-- Select Company --</option>";
                                                } else {
                                                    echo "<option value=''>Add Company First</option>";
                                                }
                                            ?>
                                        </select>
                                        <label for="company"></label>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="bike" class="form-control" id="bike" title="Please Select one option" required>
                                            <option value="">-- Select Company First --</option>
                                        </select>
                                        <label for="bike"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" id="category" name="category" title="Please Select one option" required>
                                            <option>-- Select Bike First --</option>
                                        </select>
                                        <label for="category"></label>
                                    </div>
                                </div>
                                <div class="form-group text-center col-md-12">
                                    <input type="submit" name="startFind" class="btn bg-black btn-dark w-25" value="Find Part" onclick="return validate()">
                                </div>
                            </div>
                    </fieldset>
                </form>
            </div>
            <br>

            <?php
                if(isset($_SESSION['category']) && !empty($_SESSION['category']) &&
                    isset($_SESSION['bike']) && !empty($_SESSION['bike'])
                ) {
                    $flag = false; ?>
                    <div>
                        <fieldset class="scheduler-border bg-black-10">
                            <legend class="scheduler-border font-weight-bold">PARTS</legend>
                            <div class="row m-1">
                                <?php
                                    $result = $conn->getBikePart($_SESSION['bike'], $_SESSION['category']);
                                    if($result != null){
                                        $cid = $_SESSION['category'];
                                        foreach ($result as $res) {
                                            $part = null;
                                            if(!isset($_SESSION['cart']) || in_array($res['id'], $_SESSION['cart']) === false){
                                                $flag = True;
                                                if ($cid == 1) {
                                                    $part = $conn->getTailLightInfo($res['id']);
                                                } elseif ($cid == 2) {
                                                    $part = $conn->getSilencerInfo($res['id']);
                                                } elseif ($cid == 3) {
                                                    $part = $conn->getFuelTankInfo($res['id']);
                                                } elseif ($cid == 4) {
                                                    $part = $conn->getHeadLightInfo($res['id']);
                                                } elseif ($cid == 5) {
                                                    $part = $conn->getSeatInfo($res['id']);
                                                }
                                                ?>
                                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 border bg-white p-1" >
                                                    <div class="card" style="border: 0; border-radius: 15px">
                                                        <!--img class="card-img-top" src="images/parts/<!?php echo $part['image']; ?>" alt="Part Image"-->
                                                        <div class="card-body">
                                                            <table class="table-responsive" cellpadding="5">
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>:</th>
                                                                    <td><u data-toggle="popover" data-full="../images/parts/<?php echo $part['image']; ?>" data-height="150" data-width="200"><?php echo $part['name']; ?></u></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Price</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $part['price']; ?></td>
                                                                </tr><?php
                                                                    if ($cid == 1) {
                                                                        echo "<tr>
                                                                                <th>Material</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['material'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Dimension</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['dimension'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Colour</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['color'] . "</td>
                                                                            </tr>";
                                                                    } elseif ($cid == 2) {
                                                                        echo "<tr>
                                                                                <th>Weight</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['weight'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Dimension</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['dimension'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Material</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['material'] . "</td>
                                                                            </tr>";
                                                                    } elseif ($cid == 3) {
                                                                        echo "<tr>
                                                                                <th>Capacity</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['capacity'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Colour</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['color'] . "</td>
                                                                            </tr>";
                                                                    } elseif ($cid == 4) {
                                                                        echo " <tr>
                                                                                <th>Material</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['material'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Dimension</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['dimension'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Colour</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['color'] . "</td>
                                                                            </tr>";
                                                                    } elseif ($cid == 5) {
                                                                        echo "<tr>
                                                                                <th>Type</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['Type'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Material</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['material'] . "</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Colour</th>
                                                                                <th>:</th>
                                                                                <td>" . $part['color'] . "</td>
                                                                            </tr>";
                                                                    } ?>
                                                            </table>
                                                            <br>
                                                            <div class="text-center">
                                                                <a href="functions/addToCart.php?<?php echo "q=" . $_SERVER['PHP_SELF'] . "&id=". $part['id']; ?>"
                                                                   class="btn btn-dark bg-black ">Add</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><?php
                                            }
                                        }
                                    }
                                    if(!$flag) {
                                        echo "<div class='col-12 text-center text-grey fa-2x p-5'>No Part Found</div>";
                                    }
                                ?>
                            </div>
                        </fieldset>
                    </div><?php
                }
            ?>
            <br>
            <?php
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                    <div>
                        <fieldset class="scheduler-border bg-black-10">
                            <legend class="scheduler-border font-weight-bold">CART</legend>
                            <div class="row m-1">
                                <?php
                                    $ids = $_SESSION['cart'];

                                    foreach ($ids as $id) {
                                        $cid = $conn->getPartCategoryId($id);
                                        $res = null;
                                        if ($cid == 1) {
                                            $res = $conn->getTailLightInfo($id);
                                        } elseif ($cid == 2) {
                                            $res = $conn->getSilencerInfo($id);
                                        } elseif ($cid == 3) {
                                            $res = $conn->getFuelTankInfo($id);
                                        } elseif ($cid == 4) {
                                            $res = $conn->getHeadLightInfo($id);
                                        } elseif ($cid == 5) {
                                            $res = $conn->getSeatInfo($id);
                                        } ?>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 border bg-white">
                                            <div class="card" style="border: 0;">
                                                <div class="card-body">
                                                    <table class="table-responsive" cellpadding="5">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>:</th>
                                                            <td><u data-toggle="popover" data-full="../images/parts/<?php echo $res['image']; ?>" data-height="150" data-width="200"><?php echo $res['name']; ?></u></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Price</th>
                                                            <th>:</th>
                                                            <td><?php echo $res['price']; ?></td>
                                                        </tr><?php
                                                            if ($cid == 1) {
                                                                echo "<tr>
                                                                        <th>Material</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['material'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Dimension</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['dimension'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Colour</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['color'] . "</td>
                                                                    </tr>";
                                                            } elseif ($cid == 2) {
                                                                echo "<tr>
                                                                        <th>Weight</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['weight'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Dimension</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['dimension'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Material</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['material'] . "</td>
                                                                    </tr>";
                                                            } elseif ($cid == 3) {
                                                                echo "<tr>
                                                                        <th>Capacity</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['capacity'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Colour</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['color'] . "</td>
                                                                    </tr>";
                                                            } elseif ($cid == 4) {
                                                                echo " <tr>
                                                                        <th>Material</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['material'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Dimension</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['dimension'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Colour</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['color'] . "</td>
                                                                    </tr>";
                                                            } elseif ($cid == 5) {
                                                                echo "<tr>
                                                                        <th>Type</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['Type'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Material</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['material'] . "</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Colour</th>
                                                                        <th>:</th>
                                                                        <td>" . $res['color'] . "</td>
                                                                    </tr>";
                                                            } ?>
                                                    </table>
                                                    <br>
                                                    <div class="text-center">
                                                        <a href="functions/deleteFromCart.php?<?php echo "q=" . $_SERVER['PHP_SELF'] . "&id=".$res['id']; ?>"
                                                           class="btn btn-dark bg-black ">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><?php

                                    }
                                ?>
                            </div>
                            <div class="text-center">
                                <a href="viewShop.php" class="btn btn-dark bg-black">View Shoppes</a>
                            </div>
                        </fieldset>
                    </div><?php
                }
            ?>
        </div>

        <?php require_once "includes/footer.php"?>

        <script src="assets/jquery.min.js" type="text/javascript"></script>
        <script src="assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function($) {
                let initial_target_bike = '<option value="">-- Select Company First --</option>';
                let initial_target_category = '<option value="">-- Select Bike First --</option>';

                $('#company').change(function(e) {
                    let target = "bike";
                    let cid = $(this).val();

                    $(`#`+target).html('<option value="">Loading...</option>');

                    if (cid === "") {
                        $('#'+target).html(initial_target_bike);
                    } else {
                        $.ajax({url: '/functions/listBike.php?id='+cid,
                            success: function(output) {
                                $('#'+target).html(output);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " "+ thrownError);
                            }
                        });
                    }
                });

                $('#bike').change(function(e) {
                    let target = "category";
                    let bid = $(this).val();

                    $(`#${target}`).html('<option value="">Loading...</option>');

                    if (bid === "") {
                        $('#'+target).html(initial_target_category);
                    } else {
                        $.ajax({url: '/functions/listPartCategory.php?id='+bid,
                            success: function(output) {
                                $('#'+target).html(output);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " "+ thrownError);
                            }
                        });
                    }
                });

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
                        return '<img src="' + url + '" height="' + hei + '" width="'+ wid +'">'
                    }
                });
            });
            function validate() {
                var company = document.getElementById("company");
                var bike = document.getElementById("bike");
                var category = document.getElementById("category");
                if (company.value == "") {
                    alert("Please Select the company");
                    return false;
                }
                else if (bike.value == "") {
                    alert("Please select a Bike!");
                    return false;
                }
                else if (category.value == "") {
                    alert("Please select a Category!");
                    return false;
                }
                return true;
            }
        </script>
	</body>
</html>