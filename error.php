<?php
    session_start();
    require_once "includes/Connection.php";
?>
<html lang="en">
	<head>
		<title><?php echo WEBSITE_NAME." : Error ".$_GET['err']; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
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
        <?php include_once "includes/header.php"; ?>
        <br/><br/>

        <div class="container-fluid mt-4">
            <div class="form-inline" align="center" style="min-height: 59.5vh;">
                <div class="align-middle w-100 text-dark">
                    <span class="fas fa-exclamation-triangle" style="font-size: 3.5vw"> <!-- Error logo --></span><br><br>
                    <span class="font-weight-bold" style="font-size: 3vw;">
                        <?php
                            if(isset($_GET['code']) && !empty($_GET['code']) &&
                                isset($_GET['msg']) && !empty($_GET['msg'])
                            ) {
                                echo "ERROR " . $_GET['code'] . " : " . $_GET['msg'];
                            } else{
                                echo "ERROR 404 : Page Not Found";
                            }
                        ?>
                    </span>
                    <br><br>
                    <span>Return to <a href="/index.php">homepage</a></span>
                </div>
            </div>
        </div>

        <?php include_once "includes/footer.php"; ?>

        <script src="assets/jquery.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
	</body>
</html>