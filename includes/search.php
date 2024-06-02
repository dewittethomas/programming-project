<?php
    require 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $search = '%' . $_POST["search"] . '%';
        
        $stmt = $conn -> prepare("SELECT * FROM PRODUCTS WHERE name LIKE ? OR object LIKE ? OR description LIKE ? OR brand LIKE ?");
        $stmt->bind_param("ssss", $search, $search, $search, $search);
        $stmt -> execute();
        $result = $stmt -> get_result();
        
        while ($row = $result -> fetch_assoc()) {
            echo $row["name"] . "<br>";
        }
    }
?>