<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_GET['q'];
        $con = new Connection();
        if ($con->deleteBike($_GET['id'])) {
            header("location:$dest?s=Bike Deleted Successfully");
        } else
            header("location:$dest?d=Bike Deleting Failed");
    }else{
        header("location:/error.php");
    }