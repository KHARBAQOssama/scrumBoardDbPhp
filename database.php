<?php
    
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="YoucodeScrumBoard";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);


    // // checking if the database connected 
    // if(!$conn) die("Connection failed " . mysqli_connect_error());
    // echo 'connected succeffuly';
    
