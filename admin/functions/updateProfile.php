<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['name']) && isset($_POST['email']) &&
        isset($_POST['phone']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_POST['q'];
        $con = new Connection();
        if(!empty($_POST['name']) && !empty($_POST['email']) &&
            !empty($_POST['phone'])
        ){
            if($con->updateProfile($_SESSION['admin_id'], $_POST['name'], $_POST['email'], $_POST['phone']))
                header("location:$dest?s=Profile Update Successfully");
            else
                header("location:$dest?d=Profile Update Failed");
        } else {
            header("location:$dest?w=Field Cannot be Blank");
        }

    }else{
        header("location:/error.php");
    }