<?php
    require 'connect.php';

    if (isset($_GET['search'])) {
        $search = $_GET["search"];
        $query = "SELECT * FROM PRODUCTS WHERE name LIKE '%$search%' OR object LIKE '%$search%' OR description LIKE '%$search%' OR brand LIKE '%$search%'";
    }
?>