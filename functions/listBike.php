<?php
    include "../includes/Connection.php";
    $conn = new Connection();

    $bikes = $conn->getBikeList($_GET['id']);
    if($bikes != null){
        foreach($bikes as $bike){
            echo "<option value='".$bike['id']."'>".$bike['name']."</option>";
        }
        echo "<option value='' selected>-- Select Bike --</option>";
    } else {
        echo "<option value='' selected>No Bike For This Company</option>";
    }
    mysqli_free_result($parts);
