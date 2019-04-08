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
            fieldset.scheduler-border {
                border: 3px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow:  0 0 0 0 #000;
                box-shadow:  0 0 0 0 #000;
            }

            legend.scheduler-border {
                width: inherit  ; /* Or auto */
                padding:0 10px; /* To give a bit of padding on the left and right */
                border-bottom:none;
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
            <div class="container w-75">
                <?php include "functions/responses.php"; ?>
                <br><br>
                <form action="addPart.php" method="post">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border font-weight-bold">Choose Category</legend>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <select name="category" class="form-control" style="padding-left:10px" id="category">
                                    <?php
                                        /** @var PartCategory[] $category */
                                        $category = $conn->getPartCategory();

                                        if ($category != null) {
                                            $flag = false;
                                            foreach ($category as $cat) {
                                                echo "<option value='" . $cat->getId()."'";
                                                if(isset($_POST['category']) && $_POST['category'] == $cat->getId()){ echo " selected"; $flag = true;}
                                                echo ">" . $cat->getName() . "</option>";
                                            }
                                            echo "<option value=''";
                                            if(!$flag) echo " selected";
                                            echo ">-- Select Part --</option>";
                                        } else {
                                            echo "<option>-- Add Company First --</option>";
                                        }
                                    ?>
                                </select>
                                <label for="category"></label>
                            </div>
                            <div class="form-group text-center col-md-6">
                                <button type="submit" style="background:black" class="btn btn-dark w-50" onclick="return validate()">Add</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <br><br>

                <?php if(isset($_POST['category']) && !empty($_POST['category'])) {
                    $category = $_POST['category'];
                    ?>
                    <form action="functions/savePart.php" method="post" enctype="multipart/form-data">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border font-weight-bold">Part Information</legend>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" title="Please Enter Character only" pattern="[A-Za-z]{1,30}" required placeholder="Name" name="name"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="number" class="form-control" title="Please Enter Digit only" pattern="[0-9]{1,30}" required placeholder="Price" name="price"/>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="partImage" accept="image/png,image/jpeg,image/jpg,/image/gif"/>
                                            <label class="custom-file-label">Choose Image file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <hr color="black">
                                </div>
                                <?php
                                    $cname = $conn->getCategoryName($category);
                                    switch ($cname){
                                        case "Tail Light": ?>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the digits" pattern="[a-Z][0-9]{1,3}" required placeholder="Material" name="material"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the dimension" pattern="[a-Z][0-9]{1,5}" required placeholder="Dimension" name="dimension"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Character only" pattern="[a-Z]" required placeholder="Color" name="color"/>
                                            </div><?php
                                            break;
                                        case "Silencer": ?>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Digit only" pattern="[0-9]{1,5}" required placeholder="Weight" name="weight"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Dimension" pattern="[a-Z][0-9]{1,5}" required placeholder="Dimension" name="dimension"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter information" pattern="[a-Z][0-9]{1,5}" required placeholder="Material" name="material"/>
                                            </div><?php
                                            break;
                                        case "Fuel Tanks": ?>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Digit only" pattern="[0-9]{1,5}" required placeholder="Capacity" name="capacity"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please enter the color" pattern="[a-Z][0-9]{1,5}" required placeholder="Color" name="color"/>
                                            </div><?php
                                            break;
                                        case "Head Light": ?>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Digit only" pattern="[a-Z][0-9]{1,5}" required placeholder="Material" name="material"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Digit only" pattern="[a-Z][0-9]{1,5}" placeholder="Dimension" name="dimension"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Character only" pattern="[a-zA-Z]{1,30}" required placeholder="Color" name="color"/>
                                            </div><?php
                                            break;
                                        case "Seat": ?>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Character only" pattern="[a-zA-Z]{1,30}" placeholder="Type" name="type"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the information" pattern="[a-Z][0-9]" required placeholder="Material" name="material"/>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="text" class="form-control" title="Please Enter the Character only" pattern="[a-zA-Z]{1,30}" placeholder="Color" name="color"/>
                                            </div><?php
                                            break;
                                        default:
                                            break;
                                    }
                                ?>
                                <div class="col-md-12">
                                    <hr color="black">
                                </div>
                            </div>
                            <div class="text-center form-group">
                                <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="category" value="<?php echo $category; ?>">
                                <button type="submit" style="background:black" class="btn btn-dark mt-3">Submit</button>
                            </div>
                        </fieldset>
                    </form><?php
                } ?>
            </div>
        </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript1.5">
            function validate(){
                let category = document.getElementById("category");
                if (category.value === "") {
                    alert("Please select an option!");
                    return false;
                }
                return true;
            }
    </script>
    </body>
</html>

