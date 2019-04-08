<?php
    require_once "includes/config.php";
    require_once "includes/Connection.php";

    if(isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['upload']) && !empty($_POST['upload']) &&
        isset($_POST['q']) && !empty($_POST['q'])
    ){
        $dest = $_POST['q'];
        $email = $_POST['email'];
        $private = isset($_POST['private'])?1:0;

        $con = new Connection();
        if($con->saveImage($_FILES['image'],$email, $private))
            header("location:$dest?warn=Image Uploaded Successfully");
        else
            header("location:$dest?warn=Image Uploaded Failed");
    }else
        header("location:error.php");