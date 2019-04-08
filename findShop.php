<?php
    session_start();
    require_once "includes/Connection.php";
?>

<html lang="en">
    <head>
        <title><?php echo WEBSITE_NAME." - Find Dealer"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/logo.png" type="image/png" sizes="32x32">

        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css">
        <link href="assets/main.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .dropdown-toggle::after{
                display: none; !important;
            }
        </style>
    </head>
    <body>
        <?php require_once "includes/header.php"?>
        <div class="container-fluid p-5 bg-find-shop" style="min-height: 67%;">
            <br><br>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col">
                                <input class="form-control form-control-lg form-control-borderless" size="50" pattern="[a-zA-Z]+" type="search" placeholder="Search Shop in Your Location" id="location" required>
                            </div>
                            <label for="location"></label>
                            <div class="col col-auto ml-1">
                                <button class="btn btn-lg bg-black text-white" id="search" type="button">Search</button>
                            </div>
                        </div>
                </div>
            </div><br>
            <div class="container-fluid bg-black-50" id="shopList"></div>
        </div>
        <?php require_once "includes/footer.php"?>

        <script src="assets/jquery.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#search').click(function () {
                    let loc = document.getElementById('location').value;
                    if (loc === '') {
                        alert("Enter Location First")
                    }
                    $('#shopList').load("shopList.php", {
                        location: loc
                    });
                });
            });
        </script>
    </body>
</html>