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

// Controleer de verbinding
if ($conn->connect_error) {
  die("Verbinding mislukt: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verkrijg de formuliervelden
  $naam = $_POST['naam'];
  $merk = $_POST['merk'];
  $categorie = $_POST['categorie'];
  $beschrijving = $_POST['beschrijving'];
  $subcategorie_id = $_POST['subcategorie_id'];

  // Verwerk de foto-upload
  $afbeelding = '';
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
      $target_dir = "images/products/";
      $target_file = $target_dir . basename($_FILES["foto"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Controleer of het bestand een echte afbeelding is of een neppe afbeelding
      $check = getimagesize($_FILES["foto"]["tmp_name"]);
      if ($check !== false) {
          $uploadOk = 1;
      } else {
          echo "Het bestand is geen afbeelding.";
          $uploadOk = 0;
      }

      // Controleer de bestandsgrootte
      if ($_FILES["foto"]["size"] > 500000) { // 500KB limiet
          echo "Sorry, je bestand is te groot.";
          $uploadOk = 0;
      }

      // Sta alleen bepaalde bestandsformaten toe
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
          echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
          $uploadOk = 0;
      }

      // Controleer of $uploadOk op 0 is gezet door een fout
      if ($uploadOk == 0) {
          echo "Sorry, je bestand is niet geüpload.";
      } else {
          if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
              $afbeelding = $target_file;
          } else {
              echo "Sorry, er was een probleem met het uploaden van je bestand.";
              exit;
          }
      }
  }

  // Bereid de SQL query voor
  $sql = "INSERT INTO PRODUCTEN (naam, merk, categorie, beschrijving, beschikbaarheid, id_personen, subcategorie_id, afbeelding) VALUES (?, ?, ?, ?, 1, NULL, ?, ?)";

  // Gebruik prepared statements om SQL injectie te voorkomen
  if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("ssssis", $naam, $merk, $categorie, $beschrijving, $subcategorie_id, $afbeelding);

      // Voer de query uit
      if ($stmt->execute()) {
          header("Location: index.html");
          exit;
      } else {
          echo "Fout bij het uitvoeren van de query: " . $stmt->error;
      }

      // Sluit de statement
      $stmt->close();
  } else {
      echo "Fout bij het voorbereiden van de query: " . $conn->error;
  }

  // Sluit de verbinding
  $conn->close();
}
?>
