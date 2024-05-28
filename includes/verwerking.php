<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Databaseverbinding instellingen
$servername = "dt5.ehb.be";
$username = "2324PROGPRGR07";
$password = "mTClwp3M";
$dbname = "2324PROGPRGR07";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer op verbinding
if ($conn->connect_error) {
    die("Verbinding met de database mislukt: " . $conn->connect_error);
}

// Controleer of het uitlenenForm is verzonden
if(isset($_POST['artikelnummerUitlenen'])) {
    $artikelnummer = $_POST['artikelnummerUitlenen'];
    echo $artikelnummer;

    // Update de beschikbaarheidsstatus naar 0 voor het ingevoerde artikelnummer
    $sql = "UPDATE PRODUCTS SET status = 0 WHERE id = '$artikelnummer'";

    if ($conn->query($sql) === TRUE) {
        echo "Artikel met nummer " . $artikelnummer . " is uitgeleend.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Controleer of het terugnemenForm is verzonden
if(isset($_POST['artikelnummerTerugnemen'])) {
    $artikelnummer = $_POST['artikelnummerTerugnemen'];

    // Update de beschikbaarheidsstatus naar 1 voor het ingevoerde artikelnummer
    $sql = "UPDATE PRODUCTS SET status = 1 WHERE id = '$artikelnummer'";

    if ($conn->query($sql) === TRUE) {
        echo "Artikel met nummer " . $artikelnummer . " is teruggebracht.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Sluit de databaseverbinding
$conn->close();
?>