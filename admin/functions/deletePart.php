<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_GET['q'];
        $con = new Connection();
        $fileName = $con->getPartFileName($_GET['id']);
        if($fileName != null && file_exists(PARTS_IMAGE_PATH.$fileName)) {
            if ($con->deletePart($_GET['id'])) {
                unlink(PARTS_IMAGE_PATH.$fileName);
                header("location:$dest?s=Part Deleted Successfully");
            } else
                header("location:$dest?d=Part Deleting Failed");
        } else
            header("location:$dest?w=Image Not Found");
    }else{
        header("location:/error.php");
    }