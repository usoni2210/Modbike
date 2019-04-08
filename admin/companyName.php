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
            fieldset.scheduler-border {
                border: 3px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow:  0 0 0 0 #000;
                box-shadow:  0 0 0 0 #000;
            }

            legend.scheduler-border {
                width:inherit; /* Or auto */
                padding:0 10px; /* To give a bit of padding on the left and right */
                border-bottom:none;
            }

            .dropdown-toggle::after{
                display: none; !important;
            }

            .img-logo{
                height: 25vh;
                width: 30vw;
            }

            @media (max-width: 576px) {
                .img-logo{
                    height: 30%;
                    width: 70%;
                }
            }
        </style>
    </head>
    <body>
        <?php include "includes/leftbar.php"; ?>

        <div id="right-panel" class="right-panel">
            <?php include "includes/header.php"; ?>
            <div class="container-fluid">
                <form style="border:3px solid black" method="post" action="functions/saveCompany.php" enctype="multipart/form-data">
                    <div class="container-fluid text-center bg-black text-white mb-3 p-2">
                        Add Company
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" title="Please Enter the character and number only" maxlength="50" size="50" pattern="[a-zA-Z0-9 ]+" required placeholder="Company Name" name="companyName"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="companyLogo" onchange="return fileValidate()" accept="image/png,image/jpeg,image/jpg,/image/gif" required/>
                                        <label class="custom-file-label">Choose Image file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center col-sm-4">
                                <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <button type="submit" class="btn bg-black text-white w-50">Add</button>
                            </div>
                        </div>
                    </div>
                </form>

                <br/><br/>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border font-weight-bold">Manage Company</legend>
                    <div class="control-group">
                        <div class="row">
                            <?php
                                $con = new Connection();
                                /** @var Company[] $list */
                                $list = $con->getCompanyList();
                                if($list != null){
                                    foreach($list as $company){
                                    ?>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <div class="border border-dark mb-4 bg-light position-relative" style="border-radius: 15px">
                                            <div class="position-absolute w-100" align="right">
                                                <a href="functions/deleteCompany.php?<?php echo "q=".$_SERVER['PHP_SELF']."&id=".$company->getId(); ?>" class="btn"><i class="fa fa-2x fa-times"></i></a>
                                            </div>
                                            <div class="text-center">
                                                <img src="<?php echo "../images/companyLogo/".$company->getLogoFile(); ?>" class="img-fluid p-4 img-logo" alt="Company Logo">
                                            </div>
                                            <hr class="w-100">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <p class="text-black"><?php echo $company->getName() ?></p>
                                                </div>
                                                <!--div class="col-md-5">
                                                    <i class="fas fa-edit"></i>
                                                </div-->
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-12 text-grey p-5" style="font-size: 40px" align="center">
                                        Add Company First
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <script src="../assets/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/popper/popper.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript1.5">
            function fileValidate() {
                let fileInput=document.getElementById('file');
                let filePath=fileInput.value;
                let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if(!allowedExtensions.exec(filePath)){
                    alert('Please upload file having  extension .jpg / .jpeg / .png / .gif only');
                    fileInput.value="";
                    return false;
                }else
                {
                    //image preview
                    if(fileInput.files && fileInput.files(0)){
                        let reader =new FileReader();
                        reader.onload=function (e) {
                            document.getElementById("imagePreview").innerHTML ='<img src="' +e.target.result+   '"/>';
                        };
                        reader.readAsDataURL(fileInput.files(0));

                    }
                }
            }
        </script>
    </body>
</html>

