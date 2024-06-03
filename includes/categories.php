<?php 
    require "connect.php";

    $subcategories = "SELECT * FROM SUBCATEGORIES";
    $categories = mysqli_query($conn, $subcategories);

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $query = "SELECT name, brand FROM PRODUCTS WHERE category = $category";
    }

    if (isset($_GET['subcategory'])) {
        $subcategory = $_GET['subcategory'];
        $query = "SELECT name, brand FROM PRODUCTS WHERE category = $category AND subcategory=$subcategory";
    }

?>