<?php
    require_once "includes/config.php";
    require_once "includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_POST['fdbName']) && !empty($_POST['fdbName']) &&
        isset($_POST['fdbEmail']) && !empty($_POST['fdbEmail']) &&
        isset($_POST['fdbSubject']) && !empty($_POST['fdbSubject']) &&
        isset($_POST['fdbMsg']) && !empty($_POST['fdbMsg'])
    ){
        $dest = $_GET['q'];
        $name = $_POST['fdbName'];
        $email = $_POST['fdbEmail'];
        $subject = $_POST['fdbSubject'];
        $msg = $_POST['fdbMsg'];

        $con = new Connection();
        if($con->saveFeedback($name, $email, $subject, $msg))
            header("location:$dest?warn=Feedback Sent Successfully");
        else
            header("location:$dest?warn=Feedback Sent Failed");
    }else{
        header("location:error.php");
    }
