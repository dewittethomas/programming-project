<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikelpagina</title>

    @vite('public/CSS/main.css')

</head>

<body>
    <header>
        <div class="header-top">
            <div class="container">
                <a class="logo" href="index.php" title="Home">
                    <img src="/images/logo.svg" alt="Home">
                </a>
                <form class="search-container" action="/">
                    <input type="text" placeholder="Search...">
                </form>
                <nav>
                    <img class="cart" src="images/shopping-cart.svg">
                </nav>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <ul class="category-container">
                    <li>Video</li>
                    <li>Audio</li>
                    <li>Belichting</li>
                    <li>Tools</li>
                    <li>Varia</li>
                    <li>XR</li>
                </ul>
            </div>
        </div>
    </header>

    

    <footer class="Footer">
        <div class="links">
            <a href="Voorwaarde.html">Voorwaarde</a>
            <a href="contact.html">Contact</a>
            <a href="https://www.erasmushogeschool.be/nl">&copy; Erasmushogeschool Brussel 2024</a>
          </div>
          <div class="symbolen">
            <a href="https://www.facebook.com/erasmushogeschool"><img src="images/facebook.png"></a> 
            <a href="https://twitter.com/ehbrussel"><img src="images/twitter.png"></a>
            <a href="https://www.instagram.com/erasmushogeschool/"><img src="images/instagram.png"></a>
            <a href="https://www.youtube.com/user/ehbrussel"><img src="images/youtube.png"></a>
            <a href="https://www.flickr.com/photos/erasmushogeschool"><img src="images/flickr.png"  ></a> 
          </div>
    </footer>
</body>
</html>