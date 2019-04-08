<?php
    session_start();

    if(isset($_GET['id']) && !empty($_GET['id']) &&
        isset($_GET['q']) && !empty($_GET['q'])
    ){
        $backPage = $_GET['q'];
        $id = $_GET['id'];

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }

        $key = array_search($id, $_SESSION['cart']);
        if($key !== false){
            unset($_SESSION['cart'][$key]);
            header("location:".$backPage."?s=Part Removed From Cart");
        }
    } else {
        header("location:/error.php");
    }