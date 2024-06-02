<?php
    require "connect.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $is_invalid = true;
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $stmt = $conn -> prepare("SELECT * FROM USERS WHERE username = ?");
        $stmt -> bind_param("s", $username);
        $stmt -> execute();
        $result = $stmt -> get_result();
    
        if ($result -> num_rows === 1) {
            $row = $result -> fetch_assoc();

            if (password_verify($password, $row["password"])) {
                $is_invalid = false;

                session_start();
                $_SESSION["user_id"] = $row["user_id"];

                header("Location: index.php");
                exit;
            }
        }

        $stmt -> close();
    }

    $conn -> close();
?>