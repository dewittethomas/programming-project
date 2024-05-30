<?php 
    require "connect.php";

    $sql = "SELECT category, subcategory FROM SUBCATEGORIES";
    $categories = mysqli_query($conn, $sql);
?>