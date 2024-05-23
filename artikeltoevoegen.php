<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Uitleendienst MediaLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="images/website/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-top">
            <div class="container">
                <a class="logo" href="/" title="Home">
                    <img src="/images/website/logo.svg" loading="lazy" alt="Home">
                </a>
                <nav>
                    <a class="nav-icon" href="">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
        
    </header>

    <main>
        <div id="artikelToevoegen">
        <?php
// Database configuratie
$servername = "dt5.ehb.be";
$username = "2324PROGPRGR07";
$password = "mTClwp3M"; 
$dbname = "2324PROGPRGR07";

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de gegevens van het formulier
    $naam = $_POST['naam'];
    $merk = $_POST['merk'];
    $categorie = $_POST['categorie'];
    $beschrijving = $_POST['beschrijving'];

    // Voorbereiden en binden
    $stmt = $conn->prepare("INSERT INTO PRODUCTEN (naam, merk, categorie, beschrijving) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $naam, $merk, $categorie, $beschrijving);

    // Voer de query uit
    if ($stmt->execute()) {
        echo "Nieuw artikel succesvol toegevoegd.";
    } else {
        echo "Fout bij het toevoegen van het artikel: " . $stmt->error;
    }

    // Sluit de statement en de verbinding
    $stmt->close();
    $conn->close();
}
?>


        <h2>Artikel Toevoegen</h2>
        <!--action="add_article.php" method="post" enctype="multipart/form-data"-->
        <form >
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br><br>
        
            <label for="merk">Merk:</label>
            <input type="text" id="merk" name="merk"><br><br>
        
            <label for="categorie">Categorie:</label>
            <input type="text" id="categorie" name="categorie" required><br><br>
        
            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" required></textarea><br><br>
        
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto"><br><br>
        
            <input type="submit" value="Artikel Toevoegen">
        </form>
        </div>


    </main>

    <footer>
        <div class="container">
            <div class="footer-container">
                <p>&copy; Erasmushogeschool Brussel 2024</p>
                
                <ul class="pages">
                    <li><a href="">Voorwaarden</a></li>
                    <li><a href="">Contact</a></li>
                </ul>

                <div class="socials">
                    <a class="footer-icon" href="https://www.facebook.com/erasmushogeschool" target="_blank">
                        <img src="/images/website/facebook.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.linkedin.com/school/erasmushogeschool-brussel/" target="_blank">
                        <img src="/images/website/linkedin.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://twitter.com/ehbrussel" target="_blank">
                        <img src="/images/website/twitter.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.instagram.com/erasmushogeschool/" target="_blank">
                        <img src="/images/website/instagram.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.youtube.com/user/ehbrussel" target="_blank">
                        <img src="/images/website/youtube.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.flickr.com/photos/erasmushogeschool" target="_blank">
                        <img src="/images/website/flickr.png" loading="lazy" alt="">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>