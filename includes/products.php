<?php 
    function getProducts($start, $count, $sql=null) {
        require "connect.php";

        if (!$sql) {
            $query = "SELECT DISTINCT name, brand FROM PRODUCTS GROUP BY name, brand LIMIT $count OFFSET " . ($start - 1);
        } else {
            $query = "SELECT DISTINCT name, brand FROM ($sql) AS subquery GROUP by name, brand LIMIT $count OFFSET " . ($start - 1);
        }

        $result = mysqli_query($conn, $query);

        mysqli_close($conn);
        return $result;
    }

    function getTotalPages($sql=null) {
        require "connect.php";

        if (!$sql) {
            $query = "SELECT DISTINCT name, brand FROM PRODUCTS";
        } else {
            $query = "SELECT DISTINCT name, brand FROM ($sql) AS subquery";
        }

        $result = mysqli_query($conn, $query);
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