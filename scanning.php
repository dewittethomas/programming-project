<!DOCTYPE html>
<html lang="en">
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
  <div class="scansysteem">

  <!-- Formulier om artikelnummer voor uitlenen in te voeren -->
  <form class="uitlenenForm" action="/includes/verwerking.php" method="post">
    <label for="artikelnummerUitlenen">Artikelnummer Uitlenen:</label><br>
    <input type="text" id="artikelnummerUitlenen" name="artikelnummerUitlenen" required><br><br>
    <input type="submit" value="Uitlenen">
  </form>
  
  

  <!-- Formulier om artikelnummer voor terugnemen in te voeren -->
  <form class="terugnemenForm" action="/includes/verwerking.php" method="post">
    <label for="artikelnummerTerugnemen">Artikelnummer Terugnemen:</label><br>
    <input type="text" id="artikelnummerTerugnemen" name="artikelnummerTerugnemen" required><br><br>
    <input type="submit" value="Terugnemen">
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