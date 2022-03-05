<?php


    $servername = "localhost";
    $username = "root"; // Put the MySQL Username
    $password = ""; // Put the MySQL Password
    $database = "mess_management_system"; // Put the Database Name

    // crearte connection
    $connect = new Mysqli($servername, $username, $password, $database);

    // check connection
    if($connect->connect_error) {
        die("Connection Failed : " . $connect->error);
    } else {
        // echo "Successfully Connected";
    }


?>