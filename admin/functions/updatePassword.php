<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['oldPass']) && isset($_POST['newPass']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_POST['q'];
        $con = new Connection();
        if(!empty($_POST['oldPass']) && !empty($_POST['newPass'])
        ){
            if($con->updatePassword($_SESSION['admin_id'], $_POST['newPass'], $_POST['oldPass']))
                header("location:$dest?s=Password Update Successfully");
            else
                header("location:$dest?d=Old Password Does not match");
        } else {
            header("location:$dest?w=Field Cannot be Blank");
        }
    }else{
        header("location:/error.php");
    }