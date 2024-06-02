<?php
    require 'connect.php';

    if(isset($_POST['artikelnummerUitlenen'])) {
        $artikelnummer = $_POST['artikelnummerUitlenen'];

        $sql = "UPDATE PRODUCTS SET status = 0 WHERE id = '$artikelnummer'";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../scansysteem.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['artikelnummerTerugnemen'])) {
        $artikelnummer = $_POST['artikelnummerTerugnemen'];

        $sql = "UPDATE PRODUCTS SET status = 1 WHERE id = '$artikelnummer'";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../scansysteem.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>