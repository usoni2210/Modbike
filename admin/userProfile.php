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
            .dropdown-toggle::after{
                display: none; !important;
            }
            .form-size{
                width: 50%;
            }
            @media (max-width: 768px) {
                .form-size{
                    width: 90%;
                }
            }
        </style>
    </head>
    <body>
        <?php include "includes/leftbar.php"; ?>

        <div id="right-panel" class="right-panel bg-white">
            <?php include "includes/header.php"; ?>
            <div class="container-fluid" style="min-height: 90vh">
                <?php
                    $admin = $conn->getAdminDetails($_SESSION['admin_id']);
                    include "functions/responses.php";
                ?>
                <div class="row" style="min-height: 50vh">
                    <div class="col-lg-2 col-md-4 bg-light pt-3 pb-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
                            <a class="nav-link" id="v-pills-edit-tab" data-toggle="pill" href="#v-pills-edit" role="tab" aria-controls="v-pills-edit" aria-selected="false">Edit Profile</a>
                            <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Change password</a></div>
                    </div>
                    <div class="col-lg-10 col-md-8 mt-3">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" align="center" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <h2 align="center" class="mb-4">
                                    <b>Profile</b>
                                </h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-10 text-center">
                                        <div>
                                            <img src="../images/admin/<?php echo $admin->getImage() ?>" alt="Admin Image" class="rounded-circle img-fluid" height="300" width="300"/>
                                        </div>
                                        <div class="m-4 text-black font-weight-bolder"><?php echo $admin->getUser(); ?></div>
                                    </div>
                                    <div class="col-lg-6 col-md-10 m-2 mt-5" align="left">
                                        <table class="table-responsive-sm" style="font-size: 2vh;" cellpadding="15" cellspacing="15">
                                            <tr>
                                                <th>Name</th>
                                                <th>:</th>
                                                <td><?php echo $admin->getName(); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email ID</th>
                                                <th>:</th>
                                                <td><?php echo $admin->getEmail(); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Contact No</th>
                                                <th>:</th>
                                                <td><?php echo $admin->getPhone(); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-edit" role="tabpanel" aria-labelledby="v-pills-edit-tab">
                                <h2 align="center" class="mb-4">
                                    <b>Edit Profile</b>
                                </h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-10 text-center">
                                        <div>
                                            <img src="../images/admin/<?php echo $admin->getImage() ?>" alt="Admin Image" class="rounded-circle img-fluid" height="300" width="300"/>
                                        </div>
                                        <div class="m-4 text-black font-weight-bolder"><?php echo $admin->getUser(); ?></div>
                                    </div>
                                    <div class="col-lg-6 col-md-10 m-2 mt-5" align="left">
                                        <form method="post" action="functions/updateProfile.php">
                                            <table class="table-responsive-sm" style="font-size: 2vh;" cellpadding="15" cellspacing="15">
                                                <tr class="form-group">
                                                    <th>Name</th>
                                                    <th>:</th>
                                                    <td><input class="form-control" type="text" size="50" pattern="[a-zA-Z\s]+"     value="<?php echo $admin->getName(); ?>" name="name"></td>
                                                </tr>
                                                <tr class="form-group">
                                                    <th>Email ID</th>
                                                    <th>:</th>
                                                    <td><input class="form-control" type="text" value="<?php echo $admin->getEmail(); ?>" name="email"></td>
                                                </tr>
                                                <tr class="form-group">
                                                    <th>Contact No</th>
                                                    <th>:</th>
                                                    <td><input class="form-control" type="text" value="<?php echo $admin->getPhone(); ?>" name="phone"></td>
                                                </tr>
                                                <tr class="form-group">
                                                    <td colspan="3" class="text-center">
                                                        <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                        <input class="form-control btn btn-dark bg-black w-50" type="submit" value="Update">
                                                    </td>
                                                </tr>
                                            </table><br><br>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                                <h2 align="center" class="mb-4">
                                    <b>Change Password</b>
                                </h2>
                                <br><br>
                                <div align="center">
                                    <form action="functions/updatePassword.php" class="form-size" method="post" onsubmit="return checkpassword(this)">
                                        <div class="row">
                                            <div class="col-12 form-group">
                                  <input class="form-control" type="password" name="oldPass" title="Please Enter the Current Password" size="50" required placeholder="Old Password">
                                            </div>
                                            <div class="col-12 form-group">
                                                <input class="form-control" type="password" name="newPass" size="50" required placeholder="New Password">
                                            </div>
                                            <div class="col-12 form-group">
                                                <input class="form-control" type="password" name="confPass" size="50" required placeholder="Confirm Password">
                                            <div class="col-12 form-group mt-4">
                                                <input type="hidden" name="q" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input class="form-control btn-dark bg-black w-50" type="submit" value="Change">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        </script>
    </body>
</html>

