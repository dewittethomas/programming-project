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
                <form class="search-container" action="/">
                    <input type="text" placeholder="Search...">
                </form>
                <nav>
                    <a class="nav-icon" href="winkelmand.php">
                        <img src="/images/website/shopping-cart.svg" loading="lazy">
                    </a>
                    <a class="nav-icon" href="/includes/log-out.php">
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
                        <li class="dropdown-item"><a href="">Video</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <a class="category" href="#">Camera's</a>
                                    <a href="#">Dieptecamera</a>
                                    <a href="#">Overige</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <li>Audio</li>
                    <li>Belichting</li>
                    <li>Tools</li>
                    <li>Varia</li>
                    <li>XR</li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container-voorwaarde">
        <p class="titel-voorwaarde">1. Algemene Informatie</p><br>
        <p>De uitleendienst van het medialab is een dienst die studenten en leerkrachten van de EhB de mogelijkheid biedt om materiaal te lenen
             voor hun projecten. Dit materiaal kan variëren van camera's tot belichting en audio apparatuur.</p>
        <br>
        <p class="titel-voorwaarde">2. Toegangsvoorwaarden</p><br>
        <p><b>Extern:</b> Stuur een mailtje naar medialab@ehb.be.</p>
        <p> Ben je <b>student of leerkracht</b> aan de EhB? Reserveer je materiaal via onze online uitleendienst.</p>
        <br>
        <p class="titel-voorwaarde">3. Uitleenvoorwaarden</p><br>
        <p>Bij het uitlenen van apperatuur wordt verwacht dat de lener een <b>bewijs van identiteit</b> kan voorstellen aan de medewerker van het medialab</p>
        <p>De duur van het uitlenen staat vast op een <b>maximum van 1 week</b>. Deze kan verlengd worden naar 2 weken. Niet opdagen voor een ophaling van het materiaal betekent dat de
            uitlening geannuleerd wordt en je dat je dit materiaal opnieuw moet reserveren. Wanneer je een product te laat terugbrengt krijg je een <b>waarschuwing</b>. Bij 2 waarschuwingen
            wordt je op de zwarte lijst gezet en zal het niet meer mogelijk zijn materiaal te lenen. </p>
        <br>
        <p class="titel-voorwaarde">4. Richtlijnen</p><br>
        <p>Het materiaal moet met <b>respect</b> behandeld worden. Bij indiening van het materiaal wordt het <b>gecontroleerd op schade</b>. Moest er een vorm van schade worden gevonden, word de
            gebruiker hiervoor verantwoordelijk gehouden en wordt er een <b>vorm van compensatie</b> verwacht.
        </p>
        <p>Bij het 2 keer voorkomen van schade aan materiaal wordt de gebruiker op de zwarte lijst geplaatst en is deze ongeschikt om nog verder materiaal uit te lenen.</p>
        <br>
        <p class="titel-voorwaarde">5. Diefstal</p><br>
        <p>Bij diefstal moet u de school direct verwittigen en worden meteen de hulpdiensten geïnformeerd.</p>
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
</body>
</html>