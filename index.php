<?php

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <form action="search.php" method="GET">
                <input type="text" name="query"  placeholder="Search...">
            </form>
                <nav>
                    <a class="nav-icon" href="">
                        <img src="/images/website/shopping-cart.svg" loading="lazy">
                    </a>
                    <a class="nav-icon" href="">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <form class="search-container" action="/">
                    <input type="text" placeholder="Search...">
                </form>
                <ul class="category-container">
        <div class="dropdown-container">
            <li class="dropdown-item"><a href="gezochte_producten.php?category=Video">Video</a></li>
            <div class="dropdown-content">
                <div class="container">
                    <div class="dropdown-row">
                        <a class="category" href="gezochte_producten.php?category=Camera's">Camera's</a>
                        <a href="gezochte_producten.php?category=Dieptecamera">Dieptecamera</a>
                        <a href="gezochte_producten.php?category=Overige">Overige</a>
                    </div>
                </div>
            </div>
        </div> 
        <li><a href="gezochte_producten.php?category=Audio">Audio</a></li>
        <li><a href="gezochte_producten.php?category=Belichting">Belichting</a></li>
        <li><a href="gezochte_producten.php?category=Tools">Tools</a></li>
        <li><a href="gezochte_producten.php?category=Varia">Varia</a></li>
        <li><a href="gezochte_producten.php?category=XR">XR</a></li>
    </ul>
            </div>
        </div>
    </header>
    <div class="product-container">
        <?php
        include 'db_connection.php';

        // Query om producten op te halen
        $sql = "SELECT id, naam, afbeelding FROM PRODUCTEN";
        $result = $conn->query($sql);

        // Array om bij te houden welke namen al zijn weergegeven
        $weergegevenNamen = array();

        // Producten weergeven met afbeeldingen
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Controleer of de naam al is weergegeven
                if (!in_array($row["naam"], $weergegevenNamen)) {
                    echo '<div class="product">';
                    echo '<a href="artikel.php?id=' . $row["id"] . '">';
                    // Productnaam weergeven
                    echo "<h2>" . $row["naam"] . "</h2>";
                    // Productafbeelding weergeven indien beschikbaar
                    if (!empty($row["afbeeldingID"])) {
                        echo '<img src="data:images/jpeg;base64,' . base64_encode($row["afbeeldingID"]) . '" /><br>';
                    } else {
                        echo "Geen afbeelding beschikbaar<br>";
                    }
                    echo '</a>';
                    echo '</div>';
                    
                    // Naam toevoegen aan array van weergegeven namen
                    $weergegevenNamen[] = $row["naam"];
                }
            }
        } else {
            echo "Geen producten gevonden.";
        }

        // Sluit de databaseverbinding
        $conn->close();
        ?>
    </div>
 <footer>
        <div class="container">
            <div class="footer-container">
                <p><a href="https://www.erasmushogeschool.be/nl">&copy; Erasmushogeschool Brussel 2024</a></p>
                
                <ul class="pages">
                    <li><a href="Voorwaarde.html">Voorwaarden</a></li>
                    <li><a href="contact.html">Contact</a></li>
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