<?php 
    function getProducts($start, $count, $category=null, $subcategory=null) {
        require "connect.php";

        if (!$category && !$subcategory) {
            $sql = "SELECT name, brand FROM PRODUCTS GROUP BY name, brand LIMIT $count OFFSET " . ($start - 1);
        } elseif ($category && !$subcategory) {
            $sql = "SELECT name, brand FROM PRODUCTS WHERE category = '$category' GROUP BY name, brand LIMIT $count OFFSET " . ($start - 1);
        } elseif ($category && $subcategory) {
            $sql = "SELECT name, brand FROM PRODUCTS WHERE category = '$category' AND subcategory = '$subcategory' GROUP BY name, brand LIMIT $count OFFSET " . ($start - 1);
        }

        $result = mysqli_query($conn, $sql);

        mysqli_close($conn);
        return $result;
    }

    function getPages($category=null, $subcategory=null) {
        require "connect.php";

        if (!$category && !$subcategory) {
            $sql = "SELECT DISTINCT name, brand FROM PRODUCTS";
        } elseif ($category && !$subcategory) {
            $sql = "SELECT DISTINCT name, brand FROM PRODUCTS WHERE category = '$category'";
        } elseif ($category && $subcategory) {
            $sql = "SELECT DISTINCT name, brand FROM PRODUCTS WHERE category = '$category' AND subcategory = '$subcategory'";
        }

        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);

        mysqli_close($conn);
        return ceil($rows / 10);
    }

    function getProductDetails($product, $brand=null) {
        require "connect.php";

        if ($brand) {
            $sql = "SELECT DISTINCT name, brand, object, category, subcategory, description, image FROM PRODUCTS WHERE name = '$product' AND brand = '$brand'";
        } else {
            $sql = "SELECT DISTINCT name, brand, object, category, subcategory, description, image FROM PRODUCTS WHERE name = '$product'";
        }

        $result = mysqli_query($conn, $sql);

        mysqli_close($conn);
        return $result;
    }

    function isAvailable($product) {
        require "connect.php";

        $sql = "SELECT COUNT(*) AS available FROM PRODUCTS WHERE name = '$product' AND availability = 1;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $row['available'];
    }
?>