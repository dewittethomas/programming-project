<?php
    $hostname = "dt5.ehb.be";
    $db_username = "2324PROGPRGR07";
    $db_password = "mTClwp3M";
    $database = "2324PROGPRGR07";
    
    $conn = new mysqli(hostname: $hostname, 
                       username: $db_username, 
                       password: $db_password, 
                       database: $database);

    // Check connection
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
?>