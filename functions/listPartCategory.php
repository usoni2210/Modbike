<?php
    include "../includes/Connection.php";
    $conn = new Connection();

    $parts = $conn->getBikeSupportedPartCategory($_GET['id']);
    if($parts != null){
        foreach($parts as $part){
            echo "<option value='".$part['id']."'>".$part['cat_name']."</option>";
        }
        echo "<option value='' selected>-- Select Part --</option>";
    } else {
        echo "<option value='' selected>No Part For This Bike</option>";
    }
    mysqli_free_result($parts);
