<?php 
    require "connect.php";

    $sql = "SELECT * FROM PRODUCTS";
    $result = mysqli_query($conn, $sql);

    $empty = true;

    if ($result -> num_rows > 0 ) {
        $empty = false;
    }
?>