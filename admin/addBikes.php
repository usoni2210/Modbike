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
            .iconalign{
                top: -38px;
                position: relative;
                padding: 11px;
            }
            .form-control {
                padding-left: 36px !important;
            }
            .form-group {
                height: 40px;
            }
            .form-width {
                padding: 0 30px 15px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                box-shadow: 0 2px 1px #ddd;
                margin: 0 auto;
                background-color: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
            }
            .form-header{
                margin: 0 -30px;
                margin-bottom: 30px !important;
                padding: 15px;
                box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.24);
                color:white !important;
            }
            .form-border{
                border: 2px solid black;
                border-radius:10px;
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
                <?php include "functions/responses.php"; ?>
                <div class="col-md-7 m-auto">
                    <form role="form" method="post" class="form-width form-border" action="functions/saveBikes.php" enctype="multipart/form-data">
                        <h4 class="form-header text-center bg-black">Add Bike</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control" placeholder="Bike Name" title="Enter the Bike Name" maxlength="50" size="50" pattern="[a-zA-Z0-9 ]+" name="bikeName" required/>
                                <i class="fas fa-motorcycle iconalign"></i>
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control" placeholder="Release Year" size="4" maxlength="4" pattern="[0-9]+" title="Please Enter a Valid Year" required name="releaseYear"/>
                                <i class="fas fa-calendar-alt iconalign"></i>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="companyId"></label>
                                <select name="companyId" class="form-control" style="padding-left:10px !important" title="Please Choose one Option" id="companyId">
                                    <?php
                                        $conn = new Connection();
                                        /** @var Company[] $company */
                                        $company = $conn->getCompanyList();
                                        if($company != null){
                                            foreach($company as $comp){
                                                echo "<option value='".$comp->getId()."'>".$comp->getName()."</option>";
                                            }
                                            echo "<option value='' selected>Select Company</option>";
                                        } else {
                                            echo "<option>Add Company First</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="bikeType"></label>
                                <select name="bikeType" class="form-control" style="padding-left:10px !important" id="bikeType" title="Please Choose one Option">
                                    <option value="Adventure Touring Bikes">Adventure Touring Bikes </option>
                                    <option value="Choppers">Choppers</option>
                                    <option value="Cruisers">Cruisers</option>
                                    <option value="Sport Bikes">Sport Bikes</option>
                                    <option value="Dirt Bikes">Dirt Bikes</option>
                                    <option value="Power Cruisers">Power Cruisers</option>
                                    <option value="Motocross Bikes">Motocross Bikes</option>
                                    <option value="" selected>Select Bike Type</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="form-group text-center">
                            <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <button type="submit" class="btn btn-dark bg-black" onclick="return validate()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            function validate(){
                let companyId= document.getElementById("companyId");
                let bikeType = document.getElementById("bikeType");
                if (companyId.value === "") {
                    alert("Please select a Company!");
                    return false;
                }
                else if (bikeType.value === "") {
                    alert("Please select a Bike Type!");
                    return false;
                }
                return true;
            }

        </script>
    </body>
</html>

