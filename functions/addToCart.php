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

        if(in_array($id, $_SESSION['cart'])){
            header("location:".$backPage."?w=Part already in Cart");
        } else {
            $_SESSION['cart'][]=$id;
            header("location:".$backPage."?s=Part Added to Cart");
        }
    } else {
        header("location:/error.php");
    }