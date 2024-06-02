<?php
    function getRole($id) {
        require "connect.php";

        $sql = "SELECT role FROM USERS WHERE user_id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $row['role'];
    }

    session_start();

    if (isset($_SESSION["user_id"])) {
        $_SESSION["user_role"] = getRole($_SESSION["user_id"]);
    } else {
        header("Location: login.php");
        exit;
    }
?>