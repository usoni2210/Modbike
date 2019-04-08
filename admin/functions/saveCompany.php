<?php
    require_once "../../includes/Connection.php";

    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['companyName']) && isset($_FILES['companyLogo'])
    ){
        $dest = $_POST['q'];
        if(!empty($_POST['companyName'])) {
            $con = new Connection();

            if ($con->saveCompany($_POST['companyName'], $_FILES['companyLogo']))
                header("location:$dest?s=Company Saved Successfully");
            else
                header("location:$dest?d=Company Saving Failed");
        }else
            header("location:$dest?w=Fill All Info");
    }else{
        header("location:/error.php");
    }
