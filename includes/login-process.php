<?php
    require "connect.php";
    require "roles.php";

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
                $_SESSION["user_role"] = getRole($row["user_id"]);

                if (($_SESSION["user_role"] == "user") || ($_SESSION["user_role"] == "professor")) {
                    header("Location: index.php");
                    exit;
                } elseif ($_SESSION["user_role"] == "admin") {
                    header("Location: admin.php");
                    exit;
                }
            }
        }

        $stmt -> close();
    }

    $conn -> close();
?>