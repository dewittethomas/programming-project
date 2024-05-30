<?php

include 'includes/connect.php';

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $reason = $_POST['reason'];

    $sql = "UPDATE studenten SET reason='$reason' WHERE id='$student_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Reden succesvol opgeslagen";
    } else {
        echo "Fout bij het opslaan: " . $conn->error;
    }
}

$conn->close();
?>
