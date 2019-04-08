<?php
    session_start();
    require_once "includes/Connection.php";
?>
<html lang="en">
	<head>
		<title><?php echo WEBSITE_NAME." - HOME"; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/logo.png" type="image/png" sizes="32x32">

        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css">
        <link href="assets/main.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .img-fluid{
                width: 250px;
                height:250px;
            }
            .dropdown-toggle::after{
                display: none; !important;
            }

            body{
                font-family: "cambaria ";
            }
            btn{
                text-align: center;
            }
        </style>
    </head>
	<body onload="load()">
		<?php require_once "includes/header.php"?>

        <div id="slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slide" data-slide-to="0" class="active"></li>
                <li data-target="#slide" data-slide-to="1"></li>
                <li data-target="#slide" data-slide-to="2"></li>
                <li data-target="#slide" data-slide-to="3"></li>
                <li data-target="#slide" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 img-size" src="images/slideShow/Bike1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 img-size" src="images/slideShow/Bike2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 img-size" src="images/slideShow/Bike3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 img-size" src="images/slideShow/Bike4.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 img-size" src="images/slideShow/Bike5.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#slide" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slide" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br>


        <div class="container-fluid w-75">
            <div class="row">
				<div>
                    <img class="img-fluid" src="images/collage/c2.jpg" alt="Card image cap" >
                </div>
				<div class="border col">
                    <h3 class="card-title" align="center"><b><u>Parts</u></b></h3>
                    <div class="card-body text-center">
                        <p class="text-justify">
                            We offer a huge selection of different types of parts to be modified in bikes as we are
                            offering a wide variety of modified parts as headlight, taillight, fuel tank, seat design,
                            silencer, handle bar, safety bar, foot rest,suspension, horn, tyre, etc... which will give a
                            stunning look to the bikes and you will find a range of upgrades that will reveal your bike style.
                            Here you can find different parts which make your bike more powerful and beautiful.Here we have
                            easier your work of finding right part on right place to look so you find your part easily and
                            less costly.We have a great trustworthy dealer who provide you right part to you.
                            </p>
                            <a href="/findParts.php" class="btn bg-black text-white">Check Parts</a>
                    </div>
                </div>
            </div><br/><br/>

			<div class="row">
                <div class="border col">
                    <h3 class="card-title" align="center"><b><u>Shopper Info</u></b></h3>
                    <div class="card-body text-center">
                        <p class="text-justify">
                            It is not easy for the buyer to locate authorized bike dealer and find your nearest bike
                            modifier shops and access the address and contact details of bike dealers around your
                            locality. As to find a single dealer in a city is difficult for different bike parts
                            and how to trust them with your bike. So to help you out Modbike has a widespread network
                            of bike dealers spread over different locations.Now you have a place where you can
                            find trustworthy dealers and shop for your modification.We have a large network where
                            we have shops in near your locality and cities.Here we have provided all the details about
                            the shop and its owner so you can contact them and easily locate them.
                        </p>
                        <a href="/findShop.php" class="btn bg-black text-white">View Dealer</a>
                    </div>

                </div>
                <div>
                    <img class="img-fluid" src="images/collage/c3.jpg" alt="Card image cap">
                </div>

            </div><br/><br/>

            <div class="row">
                    <div>
                        <img class="img-fluid" src="images/collage/c1.jpg" alt="Card image cap">
                    </div>
                <div class="border col">
                    <h3 class="card-title" align="center"><u><b>Modified Bikes Images</b></u></b></h3>
                    <div class="card-body text-center">
                        <p class="text-justify">
                            Modbike is a platform where we provide our best services in the field of automobile which is
                            very demanding nowadays. We have a collection of 300+ modified bikes and lots of happy
                            riders which are satisfied by our services.We have a great no of modified bikes from our locals.
                            and absolute tremendous works from the local shop keepers.You can make modification in your bike
                            either by buying parts from the locals dealer's or you can ask any dealer for modification of your bikes
                            either by your choice or dealers have a very good idea and suggestions has our dealers are skilled and best
                            and working from very long time and done a very great job by modifying a huge no of bike which you can see here.
                        </p>
                        <a href="/viewImages.php" class="btn bg-black text-white">More Images</a>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <?php require_once "includes/footer.php"?>

        <script src="assets/jquery.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/fontawesome/js/fontawesome.min.js" type="text/javascript"></script>
        <script src="assets/main.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript">
            // for change color of navbar on scroll
            let myNav;
            function load() {
                myNav = document.getElementById('navbar');
                if(window.innerWidth > 991)
                    myNav.classList.remove('bg-black');
            }
            window.onscroll = function () {
                "use strict";
                if(window.innerWidth < 992){
                    myNav.classList.add("bg-black");
                }
                else if(document.body.scrollTop >= window.innerHeight-50) {
                    myNav.classList.add("bg-black");
                    myNav.classList.remove("bg-black-semitransparent");
                }else if (document.body.scrollTop >= 50 ) {
                    myNav.classList.add("bg-black-semitransparent");
                    myNav.classList.remove("bg-black");
                }else {
                    myNav.classList.remove("bg-black", "bg-black-semitransparent");
                }
            };
        </script>
	</body>
</html>