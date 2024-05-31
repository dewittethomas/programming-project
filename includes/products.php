<?php 
    require "connect.php";

    $sql = "SELECT * FROM PRODUCTS";
    $result = mysqli_query($conn, $sql);

    $empty = true;

    if ($result -> num_rows > 0 ) {
        $empty = false;
    }

    function isAvailable($product) {
        require "connect.php";

        $sql = "SELECT EXISTS(SELECT 1 FROM PRODUCTS WHERE name = '$product' AND availability = 1) AS available";
        $available = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($available);

        mysqli_close($conn);
        return $row['available'];
    }
?>