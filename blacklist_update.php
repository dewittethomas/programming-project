<?php

include 'db_connection.php';

// Verkrijg de user_id en blacklist status van het formulier
$user_id = intval($_POST['user_id']);
$blackliststatus = isset($_POST['blackliststatus']) ? 1 : 0;

// Bereid de SQL query voor om de blacklist status bij te werken
$sql = "UPDATE USERS SET blackliststatus = ? WHERE user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $blackliststatus, $user_id);

if ($stmt->execute()) {
    echo "Blackliststatus: " . $blackliststatus . " updated successfully.";
} else {
    echo "Error updating record: " . $conn->error;
}

// Sluit de verbinding
$stmt->close();
$conn->close();
?>
