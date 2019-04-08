<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['part']) && isset($_POST['bike']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_POST['q'];
        if(!empty($_POST['part']) && !empty($_POST['bike'])) {
            $con = new Connection();

            if ($con->savePartHave($_POST['bike'], $_POST['part']))
                header("location:$dest?s=Bike Part Relation Saved");
            else
                header("location:$dest?d=Operation Failed");
        }else
            header("location:$dest?w=Fill All Info");
    }else{
        header("location:/error.php");
    }
