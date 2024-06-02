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
  $name = $_POST['name'];
  $brand = $_POST['brand'];
  $category = $_POST['category'];
  $subcategory = $_POST['subcategory'];
  $object = $_POST['object'];
  $description = $_POST['description']; 

  // Verwerk de foto-upload
  $image = '';
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $target_dir = "../images/products/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Controleer of het bestand een echte afbeelding is of een neppe afbeelding
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if ($check !== false) {
          $uploadOk = 1;
      } else {
          echo "Het bestand is geen afbeelding.";
          $uploadOk = 0;
      }

      // Controleer de bestandsgrootte
      if ($_FILES["image"]["size"] > 5000000) { //limiet
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
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              $image = $target_file;
          } else {
              echo "Sorry, er was een probleem met het uploaden van je bestand.";
              exit;
          }
      }
  }

  // Bereid de SQL query voor
  $sql = "INSERT INTO PRODUCTS (name, brand, category, object, description, availability,subcategory,image) VALUES (?, ?, ?, ?,?, 1, ?, ?)";

  // Gebruik prepared statements om SQL injectie te voorkomen
  if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("ssissis", $name, $brand, $category, $object,$description,$subcategory,$image);

      // Voer de query uit
      if ($stmt->execute()) {
          header("Location: ../artikel-toevoegen.php");
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