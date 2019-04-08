<?php
    require_once "includes/function.php";

    if(isset($_COOKIE['cookie_user']) && !empty($_COOKIE['cookie_user']) &&
        isset($_COOKIE['cookie_pass']) && !empty($_COOKIE['cookie_pass']) &&
        !isset($_SESSION['admin_id'])
    ) {
        $conn = new Connection();
        if(($id = $conn->validateAdmin($_COOKIE['cookie_user'], $_COOKIE['cookie_pass'])) != null) {
            $admin = $conn->getBasicDetails($id);
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $admin->getName();
            $_SESSION['admin_image'] = $admin->getImage();
        } else {
            deleteCookie();
        }
    }

    if(isset($_GET['warn']))  {
		echo "
		<script type=\"text/javascript\" language=\"JavaScript\">
            alert(\"".$_GET['warn']."\");
        </script>";
    }
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black" id="navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topbar" aria-controls="topbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="topbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link<?php if($_SERVER['PHP_SELF'] == "/index.php") echo " active"; ?>" href="http://modbike.com">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php if($_SERVER['PHP_SELF'] == "/findParts.php") echo " active"; ?>" href="/findParts.php">Find Parts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php if($_SERVER['PHP_SELF'] == "/findShop.php") echo " active"; ?>" href="/findShop.php">Find Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php if($_SERVER['PHP_SELF'] == "/viewImages.php") echo " active"; ?>" href="/viewImages.php">Modified Bikes</a>
            </li>
            <li class="nav-item">
                <span class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#feedbackModal">Feedback</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#aboutus">About us</a>
            </li>
        </ul>
    </div>
    <div class="navbar-right">
        <?php if(!isset($_SESSION['admin_id'])){ ?>
            <span data-toggle="modal" data-target="#loginModal">
                <i class="fa fa-user-circle text-light mr-3" style="font-size: 28px;"></i>
            </span>
        <?php } else { ?>
            <!-- Nav Item - User Information -->
            <div class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" style="height: 2em; width: 2em" src="../images/admin/<?php echo $_SESSION['admin_image']; ?>" alt="image">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" style="margin-top: 8px" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/admin/index.php">
                        <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Dashboard
                    </a>
                    <a class="dropdown-item" href="/admin/userProfile.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/admin/logout.php?q=<?php echo $_SERVER['PHP_SELF']; ?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</nav>

<?php
    //Login Modal Visible when Admin not Logged in
    if(!isset($_SESSION['admin_id'])){ ?>
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog" style="top: 10%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <h4 class="float-left"><span class="fas fa-lock"></span> Login</h4>
                        <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" method="post" action="/admin/index.php">
                            <div class="form-group">
                                <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                                <input type="text" class="form-control" id="username" title="Please Enter Correct User Name" size="40" maxlength="40" required placeholder="Username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                <input type="password" class="form-control" id="psw" title="Please Enter Correct password" size="40" maxlength="40" required placeholder="Password" name="password">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" checked>
                                <label class="form-check-label" for="remember-me">Remember me</label>
                            </div>
                            <br>
                            <button type="submit" class="btn bg-black text-white btn-block"><span class="fas fa-key"></span> Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><?php
    }
?>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" role="dialog">
    <div class="modal-dialog" style="top: 10%; max-width: 50%">
        <div class="modal-content">
            <div class="container feedback-form">
                <div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="text-dark">&times;</span>
                    </button>
                    <div class="feedback-image bg-transparent">
                        <img src="/images/feedback_rocket.png" alt="rocket_feedback"/>
                    </div>
                </div>
                <form method="post" action="/sendFeedback.php?q=<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h3 style="margin-bottom: 5%; color: black;">Drop Us a Message</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="fdbName" class="form-control" title="Please Enter the name" size="20" maxlength="20" pattern="[a-zA-Z\s]+" placeholder="Full Name" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="fdbEmail" class="form-control" title="Please Enter the Correct Email id" size="60" maxlength="60" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email Address" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="fdbSubject" class="form-control" title="Please Enter Some subject" size="60" maxlength="60" pattern="[a-zA-Z0-9\s]+" placeholder="Subject" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea name="fdbMsg" class="form-control" title="Please Enter between 10 to 300 words" size="300" maxlength="300" placeholder="Message..." style="width: 100%; height: 150px;" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10%; margin-bottom: -5%;">
                        <div class="col-sm-12">
                            <div class="form-group" align="center">
                                <input type="submit" name="btnSubmit" class="btnfeedback" value="Send Message" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

