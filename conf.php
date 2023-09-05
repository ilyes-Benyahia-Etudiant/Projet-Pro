<?php 
    

    $conn = new mysqli("localhost", "root", "", "burger_code");

    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }


?>

