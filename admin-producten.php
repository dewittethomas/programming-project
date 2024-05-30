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
                <a class="logo" href="admin.php" title="Home">
                    <img src="/images/website/logo.svg" loading="lazy" alt="Home">
                </a>
                <form class="search-container" action="/">
                    <input class="search-glass" type="text" placeholder="Search...">
                </form>
                <nav>
                    <a class="nav-icon" href="">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <ul class="category-container">
                    <li><a href="scanning.php">Scanning</a></li>
                    <li><a href="artikel-toevoegen.php">Artikel toevoegen</a></li>
                    <li><a href ="blacklist.php">Blacklist</a></li>
                    <li><a href ="admin-producten.php">Producten</a></li>
                </ul>
            </div>
        </div>
    </header>   

   <div class="admin-product-container">
        <?php
        include 'includes/connect.php';

        // Check if delete request is made
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
            $delete_id = intval($_POST['delete_id']);
            $delete_sql = "DELETE FROM PRODUCTS WHERE id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            if ($stmt->execute()) {
                echo "Product succesvol verwijderd.";
                header("refresh:5;url=admin-producten.php");
            } else {
                echo "Fout bij het verwijderen van het product.";
            }
        }

        // Query om producten op te halen
        $sql = "SELECT id,name, brand, image, description, COUNT(*) as quantity
        FROM PRODUCTS
        GROUP BY id,name, brand,image, description";
        $result = $conn->query($sql);

        // Array om bij te houden welke namen al zijn weergegeven
        $weergegevenNamen = array();

        // Producten weergeven met afbeeldingen
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Controleren op duplicaties
                if (!in_array($row["name"], $weergegevenNamen)) {
                    echo '<div class="admin-product">';
                    // Productafbeelding weergeven indien beschikbaar
                    $imagePath = 'images/products/' . $row["image"]; // Pad naar de afbeelding
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="" class="artikel-foto"/>';
                    } 
                    else {
                        echo '<img src="images/no-image-available.png" alt="" class="artikel-foto"/>';
                    }
                    echo '<div class="product-details">';
                    echo '<div class="product-header">';
                    // Productnaam weergeven
                    echo "<h2>" . $row["name"] . "</h2>";
                    // Delete button with form
                    echo '<form method="POST" action="" onsubmit="return confirm(\'Weet je zeker dat je dit product wilt verwijderen?\');">';
                    echo '<input type="hidden" name="delete_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="delete-button">🗑️</button>';
                    echo '</form>';
                    echo '</div>';
                    // Productmerk weergeven
                    echo '<div class="product-brand">Merk: ' . $row["brand"] . '</div>';
                    // Producthoeveelheid weergeven
                    echo '<div class="product-quantity">Hoeveelheid: ' . $row["quantity"] . '</div>';
                    // Productbeschrijving weergeven
                    echo '<div class="product-description">Beschrijving: ' . $row["description"] . '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Naam toevoegen aan array van weergegeven namen
                    $weergegevenNamen[] = $row["name"];
                }
            }
        } else {
            echo "Geen producten gevonden.";
        }

        $conn->close();
        ?>


    </div>
    

    <footer>
        <div class="container">
            <div class="footer-container">
                <p><a href="https://www.erasmushogeschool.be/nl">&copy; Erasmushogeschool Brussel 2024</a></p>

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