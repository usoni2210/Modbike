<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_GET['q'];
        $con = new Connection();
        $fileName = $con->getImageFileName($_GET['id']);
        if($fileName != null && file_exists(MODIFIED_BIKE_IMAGE_PATH.$fileName)) {
            if ($con->deleteImage($_GET['id'])) {
                unlink(MODIFIED_BIKE_IMAGE_PATH . $fileName);
                unlink(MODIFIED_BIKE_THUMBNAIL_PATH . $fileName);
                header("location:$dest?s=Image Deleted Successfully");
            } else
                header("location:$dest?w=Image Deleting Failed");
        } else
            header("location:$dest?w=Image Not Found");
    }else{
        header("location:/error.php");
    }