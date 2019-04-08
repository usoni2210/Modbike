<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_GET['op']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_GET['q'];
        $id = $_GET['id'];
        $op = $_GET['op'];
        $con = new Connection();

        if ($op == 0) {
            if ($con->disableImage($id,$_SESSION['admin_id']))
                header("location:$dest?w=Image Disabled Successfully");
            else
                header("location:$dest?d=Operation Failed");
        } elseif ($op == 1){
            if ($con->enableImage($id))
                header("location:$dest?s=Image Enabled Successfully");
            else
                header("location:$dest?d=Operation Failed");
        } else
            header("location:/error.php?code=9001&msg=Undefined Operation");

    }else{
        header("location:/error.php");
    }