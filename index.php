<?php
    require 'includes/session.php';
    require 'includes/products.php';
    require 'includes/categories.php';
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
                    <input class="search-glass focus" type="text" placeholder="Search...">
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
                    <input class="search-glass focus" type="text" placeholder="Search...">
                </form>

                <ul class="category-container">
                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">Video</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == "Video") {
                                            echo "<a href='#'>{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">Audio</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == "Audio") {
                                            echo "<a href='#'>{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">Belichting</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == "Belichting") {
                                            echo "<a href='#'>{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">Tools</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == "Tools") {
                                            echo "<a href='#'>{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">Varia</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == "Varia") {
                                            echo "<a href='#'>{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">XR</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == "XR") {
                                            echo "<a href='#'>{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="product-container">
                <?php
                $products = array();

                if (!$empty) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if (!in_array($row["name"], $products)) {
                            echo '<div class="product">';

                            if ($row["image"]) {
                                $image_path = "images/products/{$row["image"]}";

                                if (file_exists($image_path)) {
                                    echo "<img src='/{$image_path}' loading='lazy'>";
                                } else {
                                    echo "<img src='/images/products/not-found.jpg' loading='lazy'>";
                                }
                            } else {
                                echo "<img src='/images/products/not-found.jpg' loading='lazy'>";
                            }

                            echo "<div class='product-information'>";
                            echo "<a class='product-title' href='artikel.php?id={$row["id"]}'>{$row["name"]}</a>";
                            echo "<a class='product-subtitle'>{$row["brand"]} | {$row["object"]}</a>";
                            echo "<p>{$row["description"]}</p>";
                            echo "<div class='product-footer'>";

                            if (isAvailable($row["name"])) {
                                echo "<a class='product-availability'>Beschikbaar</a>";

                            } else {
                                echo "<a class='product-availability'>Niet beschikbaar</a>";
                            }
                            
                            echo "<button class='submit-button product-reservation'>Leen uit</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

                            $products[] = $row["name"];
                        }
                    }
                } else {
                    echo "Geen producten gevonden.";
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-container">
                <p>&copy; Erasmushogeschool Brussel 2024</p>
                
                <ul class="pages">
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