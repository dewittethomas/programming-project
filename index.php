<?php
    require 'includes/session.php';
    require 'includes/products.php';
?>
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
                    <input class="search-glass" type="text" placeholder="Search...">
                </form>
                <nav>
                    <a class="nav-icon" href="winkelmandje.php">
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

    <main>
        <div class="product-container">
        <?php
        $shown_names = array();

        if (!$empty) {
            while($row = mysqli_fetch_assoc($result)) {
                if (!in_array($row["name"], $shown_names)) {
                    $image_path = 'images/' . $row["image"]; 

                    echo '<div class="product">';
                    echo '<a href="artikel.php?id=' . $row["id"] . '">';
                    echo "<h2>" . $row["name"] . "</h2>";
                    if (file_exists($image_path)) {
                        echo '<img src="' . $image_path . '" alt="" class= "artikel-foto"/><br>';
                    } 
                    else {
                        echo "No image available<br>";
                    }
                    echo '</a>';
                    echo '</div>';

                    $shown_names[] = $row["name"];
                }
            }
        } else {
            echo "Geen producten gevonden.";
        }

        mysqli_close($conn);
        ?>
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