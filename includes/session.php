<?php
    require "roles.php";

    session_start();

    if (isset($_SESSION["user_id"])) {
        $_SESSION["user_role"] = getRole($_SESSION["user_id"]);
    } else {
        header("Location: login.php");
        exit;
    }
?>