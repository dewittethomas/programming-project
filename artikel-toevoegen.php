<?php
    require "includes/session.php";

    if ($_SESSION["user_role"] != "admin") {
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheerder MediaLab</title>
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
                <nav>
                    <a class="nav-icon" href="/includes/log-out.php">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <ul class="category-container">
                    <li><a href="admin.php">Agenda</a></li>
                    <li><a href="scansysteem.php">Scansysteem</a></li>
                    <li><a href="admin-artikels.php">Artikels</a></li>
                    <li class="current-category"><a href="artikel-toevoegen.php">Artikel toevoegen</a></li>
                    <li><a href="blacklist.php">Blacklist</a></li>
                    <li><a href="waarschuwen.php">Waarschuwen</a></li>
                </ul>
            </div>
        </div>
        
    </header>

    <main>
        <div class="artikelToevoegen">
        
        <h2>Artikel Toevoegen</h2>
        
        <form action="/includes/add-article.php" method="post" enctype="multipart/form-data">
            <label for="naam">Naam:</label>
            <input type="text" id="name" name="name" required><br><br>
        
            <label for="merk">Merk:</label>
            <input type="text" id="brand" name="brand"><br><br>
        
            
            <label for="category">Categorie:</label>
            <select id="category" name="category">
                <option value="1">Video</option>
                <option value="2">Audio</option>
                <option value="3">Belichting</option>
                <option value="4">Tools</option>
                <option value="5">Varia</option>
                <option value="6">XR</option>
            </select><br><br>
            <label for="subcategory">Subcategorie:</label>
            <select id="subcategory" name="subcategory">
                <!-- Opties via subcategory.js -->
            </select><br><br>
            <label for="object">Objectsoort:</label>
            <input type="text" id="object" name="object" required><br><br>

            <label for="description">Beschrijving:</label>
            <textarea id="description" name="description" required></textarea><br><br>
        
            <label for="image">Foto:</label>
            <input type="file" id="image" name="image"><br><br>
        
            <input type="submit"  value="Artikel Toevoegen">
        </form>
        </div>


    </main>

    <footer>
        <div class="container">
            <div class="footer-container">
                <p>&copy; Erasmushogeschool Brussel 2024</p>
                
                <ul class="links">
                    <li><a href="voorwaarden.php">Voorwaarden</a></li>
                    <li><a href="contact.php">Contact</a></li>
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
    
<script src="scripts/subcategory.js"></script>
</body>
</html>