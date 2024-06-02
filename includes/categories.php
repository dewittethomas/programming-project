<?php 
    require "connect.php";

    $category = null;
    $subcategory = null;

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
    }

    if (isset($_GET['subcategory'])) {
        $subcategory = $_GET['subcategory'];
    }

    $sql = "SELECT * FROM SUBCATEGORIES";
    $categories = mysqli_query($conn, $sql);
?>