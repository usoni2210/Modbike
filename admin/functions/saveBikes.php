<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_POST['bikeName']) && isset($_POST['releaseYear']) &&
        isset($_POST['companyId']) && isset($_POST['bikeType']) &&
        isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $backPage = $_POST['q'];
        if(!empty($_POST['bikeName']) && !empty($_POST['releaseYear']) &&
            !empty($_POST['companyId']) && !empty($_POST['bikeType'])
        ){
            $con = new Connection();
            if($con->saveBike($_POST['bikeName'], $_POST['releaseYear'], $_POST['bikeType'], $_POST['companyId']))
                header("location:".$backPage."?s=Bike Info Inserted Successfully");
            else
                header("location:".$backPage."?d=Bike Info Inserting Failed");
        } else {
            header("location:".$backPage."?w=Bike Info Not Complete");
        }
    } else {
        header("location:/error.php");
    }