<?php 
    require "connect.php";

    $query = "SELECT name, brand FROM PRODUCTS";
    $category = null;
    $subcategory = null;

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $query = "SELECT name, brand FROM PRODUCTS WHERE category = $category";
    }

    if (isset($_GET['subcategory'])) {
        $subcategory = $_GET['subcategory'];
        $query = "SELECT name, brand FROM PRODUCTS WHERE category = $category AND subcategory=$subcategory";
    }

    $subcategories = "SELECT * FROM SUBCATEGORIES";
    $categories = mysqli_query($conn, $subcategories);
?>