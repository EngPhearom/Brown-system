<?php

    $localhost = "localhost";
    $username = "root";
    $password = "";
    $database = "brownsystem";

    // connection db
    $conn = new mysqli($localhost,$username,$password,$database);

    // check connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
?>