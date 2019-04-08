<?php
    session_start();
    require_once "../../includes/Connection.php";

    print_r($_POST);
    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['part']) && isset($_POST['shop']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_POST['q'];
        if(!empty($_POST['part']) && !empty($_POST['shop'])) {
            $con = new Connection();

            if ($con->savePartSales($_POST['shop'], $_POST['part']))
                header("location:$dest?s=Operation Successful");
            else
                header("location:$dest?d=Operation Failed");
        }else
            header("location:$dest?w=Fill All Info");
    }else{
        header("location:/error.php");
    }
