<?php
    require_once "../includes/function.php";
    deleteCookie();

    session_start();
    if(isset($_SESSION['admin_id'])) {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_image']);
        session_destroy();
    }session_abort();

    print_r($_SESSION);
    print_r($_COOKIE);
    $ref= $_GET['q'];
    if($ref != null) {
        header("location:$ref");
    } else {
        header("location:/index.php");
    }



