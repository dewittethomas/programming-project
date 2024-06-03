<?php 
    function getRole($id) {
        require "connect.php";

        $sql = "SELECT role FROM USERS WHERE user_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $row['role'];
    }
?>