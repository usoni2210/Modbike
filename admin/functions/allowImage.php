<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_GET['q'];
        $con = new Connection();
        if($con->allowImage($_GET['id'], $_SESSION['admin_id']))
            header("location:$dest?s=Image Allowed Successfully");
        else
            header("location:/$dest?w=Image Allowing Failed");
    }else{
        header("location:/error.php");
    }