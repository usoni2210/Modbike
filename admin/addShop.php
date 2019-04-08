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
                    <form role="form" method="post" class="form-width form-border" action="functions/saveShop.php" enctype="multipart/form-data">
                        <h4 class="form-header text-center bg-black">Add Shop</h4>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Character only" size="10" maxlength="20" pattern="[A-z\s]+" required placeholder="Owner Name" name="ownerName"/>
                                <i class="fa fa-user iconalign"></i>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Digit only" maxlength="10" size="10" pattern="[0-9]+" required placeholder="Contact" name="contactNo"/>
                                <i class="fa fa-phone fa fa-flip-horizontal iconalign"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" title="Please Enter valid Shop Name" size="50" maxlength="50" pattern="[a-zA-Z0-9\s]+" required placeholder="Shop Name" name="shopName"/>
                                <i class="fa fa-store iconalign"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="shopImage" id="file" onchange="return fileValidate()" accept="image/png,image/jpeg,image/jpg,/image/gif"/>
                                        <label class="custom-file-label">Choose Image file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Character and digit" size="50" maxlength="50" pattern="[a-zA-Z0-9\s]+" required placeholder="Address Line 1" name="fLineAddr" />
                                <i class="fa fa-street-view iconalign"></i>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Character and digit" size="50" maxlength="50" pattern="[a-zA-Z0-9\s]+" required placeholder="Address Line 2" name="sLineAddr"/>
                                <i class="fa fa-street-view iconalign"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Character only" size="30" maxlength="30" pattern="[A-z\s]+" required placeholder="City" name="city"/>
                                <i class="fa fa-map-marker-alt iconalign"></i>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Character only" size="30" maxlength="30" pattern="[A-z\s]+" required placeholder="State" name="state"/>
                                <i class="fa fa-map-marked-alt iconalign"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" title="Please Enter the Digit only" size="6" maxlength="6" pattern="[0-9]+" placeholder="Pin Code" name="pinCode" required\
                                />
                                <i class="fa fa-keyboard iconalign"></i>
                            </div>
                        </div>
                        <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group text-center">
                            <button type="submit" style="background:black" class="btn btn-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="application/javascript">
            let fileInput=document.getElementById('file');
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            function fileValidate() {
                if(!allowedExtensions.exec(fileInput.value)){
                    alert('Please upload file having  extension .jpg / .jpeg / .png / .gif only');
                    fileInput.value="";
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>

