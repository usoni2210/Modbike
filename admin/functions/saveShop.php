<?php
    require_once "../../includes/Connection.php";

    print_r($_POST);
    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['ownerName']) && isset($_POST['contactNo']) &&
        isset($_POST['shopName']) && isset($_POST['fLineAddr']) &&
        isset($_POST['sLineAddr']) && isset($_POST['city']) &&
        isset($_POST['state']) && isset($_POST['pinCode'])
    ){
        $dest = $_POST['q'];
        if(!empty($_POST['ownerName']) && !empty($_POST['contactNo']) &&
            !empty($_POST['shopName']) && !empty($_POST['fLineAddr']) &&
            !empty($_POST['sLineAddr']) && !empty($_POST['city']) &&
            !empty($_POST['state']) && !empty($_POST['pinCode'])
        ) {
            $con = new Connection();
            if ($con->saveShop($_FILES['shopImage'], $_POST['ownerName'], $_POST['contactNo'], $_POST['shopName'], $_POST['fLineAddr'], $_POST['sLineAddr'], $_POST['city'], $_POST['state'], $_POST['pinCode']))
                header("location:$dest?s=Shop Added Successfully");
            else
                header("location:$dest?d=Shop Adding Failed");
        }
        else{
            header("location:$dest?w=Fill All Info");
        }
    }else{
        header("location:/error.php");
    }
