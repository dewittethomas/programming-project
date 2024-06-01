<?php 
    function getProducts($start, $count) {
        require "connect.php";

        $sql = "SELECT name, brand FROM PRODUCTS GROUP BY name, brand LIMIT $count OFFSET " . ($start - 1);
        $result = mysqli_query($conn, $sql);

        mysqli_close($conn);
        return $result;
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