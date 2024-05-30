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
                <option value="Video">Video</option>
                <option value="Audio">Audio</option>
                <option value="Belichting">Belichting</option>
                <option value="Tools">Tools</option>
                <option value="Varia">Varia</option>
                <option value="XR">XR</option>
            </select><br><br>
                
                
            
        
            <label for="beschrijving">Beschrijving:</label>
            <input type="text" id="description" name="description" required><br><br>
        
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto"><br><br>
        
            <input type="submit"  value="Artikel Toevoegen">
        </form>
        </div>


    </main>

    <footer>
        <div class="container">
            <div class="footer-container">
                <p>&copy; Erasmushogeschool Brussel 2024</p>
                

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