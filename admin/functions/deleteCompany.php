<?php
    session_start();
    require_once "../../includes/Connection.php";

    if(isset($_GET['q']) && !empty($_GET['q']) &&
        isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_GET['q'];
        $con = new Connection();
        $fileName = $con->getCompanyFileName($_GET['id']);
        if($fileName != null && file_exists(COMPANY_LOGO_PATH.$fileName)) {
            if ($con->deleteCompany($_GET['id'])) {
                unlink(COMPANY_LOGO_PATH . $fileName);
                header("location:$dest?s=Company Details Deleted Successfully");
            } else
                header("location:$dest?d=Operation Failed");
        } else
            header("location:$dest?w=Image Not Found");
    }else{
        header("location:/error.php");
    }