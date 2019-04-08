<?php
    session_start();
    require_once "../../includes/Connection.php";

    print_r($_FILES);
    print_r($_POST);
    if(isset($_POST['q']) && !empty($_POST['q']) &&
        isset($_POST['name']) && isset($_POST['category']) &&
        isset($_POST['price']) &&
        isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])
    ){
        $dest = $_POST['q'];
        if(!empty($_POST['name']) && !empty($_POST['category']) &&
            !empty($_POST['price'])
        ) {
            $category = $_POST['category'];
            $con = new Connection();
            if (($id = $con->savePart($_FILES['partImage'], $_POST['name'], $category, $_POST['price'])) != 0) {
                $cname = $con->getCategoryName($category);
                switch ($cname) {
                    case "Silencer":
                        $con->saveSilencer($id, $_POST['weight'], $_POST['dimension'], $_POST['material']);
                        break;
                    case "Tail Light":
                        $con->saveTailLight($id, $_POST['material'], $_POST['dimension'], $_POST['color']);
                        break;
                    case "Fuel Tanks":
                        $con->saveFuelTank($id, $_POST['capacity'], $_POST['color']);
                        break;
                    case "Head Light":
                        $con->saveHeadLight($id, $_POST['material'], $_POST['dimension'], $_POST['color']);
                        break;
                    case "Seat":
                        $con->saveSeat($id, $_POST['type'], $_POST['material'], $_POST['color']);
                        break;
                    default:
                        header("location:error.php?code=8001&msg=Part Info Not Completely Saved");
                }
                header("location:$dest?s=Part Added Successfully");
            } else {
                header("location:$dest?d=Part Adding Failed");
            }
        }
        else{
            header("location:$dest?w=Fill All Info");
        }
    }else{
        header("location:/error.php");
    }
    exit();
