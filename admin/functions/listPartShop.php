<?php
    include "../../includes/Connection.php";
    $conn = new Connection();

    $parts = $conn->getShopPartList($_GET['id']);
    if($parts != null){
        foreach($parts as $part){
            echo "<option value='".$part['id']."'>".$part['cat_name']." - ".$part['name']."</option>";
        }
        echo "<option value='' selected>-- Select Part --</option>";
    } else {
        echo "<option value='' selected>Add Part First</option>";
    }
    mysqli_free_result($parts);
