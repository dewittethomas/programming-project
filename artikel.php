<?php
    require 'includes/session.php';
    require 'includes/categories.php';
    require 'includes/article.php'
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
                <form method="get" action="/" class="search-container">
                    <input class="search-glass focus" name="search" type="text" placeholder="Search...">
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
                <form method="get" action="/" class="search-container">
                    <input class="search-glass focus" type="text" placeholder="Search...">
                </form>

                <ul class="category-container">
                    <div class="dropdown-container">
                        <li class="dropdown-item <?php echo ($category == 1) ? 'current-category' : ''; ?>"><a href="/?category=1">Video</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);
                                    
                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 1) {
                                            echo "<a href='/?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
                                            if ($row["subcategory_id"] == $subcategory)  {
                                                echo " class='current-subcategory'";
                                            }
                                            echo ">{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item <?php echo ($category == 2) ? 'current-category' : ''; ?>"><a href="/?category=2">Audio</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 2) {
                                            echo "<a href='/?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
                                            if ($row["subcategory_id"] == $subcategory)  {
                                                echo " class='current-subcategory'";
                                            }
                                            echo ">{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item <?php echo ($category == 3) ? 'current-category' : ''; ?>"><a href="/?category=3">Belichting</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 3) {
                                            echo "<a href='/?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
                                            if ($row["subcategory_id"] == $subcategory)  {
                                                echo " class='current-subcategory'";
                                            }
                                            echo ">{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item <?php echo ($category == 4) ? 'current-category' : ''; ?>"><a href="/?category=4">Tools</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 4) {
                                            echo "<a href='/?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
                                            if ($row["subcategory_id"] == $subcategory)  {
                                                echo " class='current-subcategory'";
                                            }
                                            echo ">{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item <?php echo ($category == 5) ? 'current-category' : ''; ?>"><a href="/?category=5">Varia</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 5) {
                                            echo "<a href='/?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
                                            if ($row["subcategory_id"] == $subcategory)  {
                                                echo " class='current-subcategory'";
                                            }
                                            echo ">{$row["subcategory"]}</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <li class="dropdown-item <?php echo ($category == 6) ? 'current-category' : ''; ?>"><a href="/?category=6">XR</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 6) {
                                            echo "<a href='/?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
                                            if ($row["subcategory_id"] == $subcategory)  {
                                                echo " class='current-subcategory'";
                                            }
                                            echo ">{$row["subcategory"]}</a>";
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
            <div class="article-container">
                <?php 
                echo "<div class='article-information'>";
                echo "<h2>{$name}</h2>";
                echo "<a class='product-subtitle'>{$article['brand']} | {$article['object']}</a>";
                
                echo "</div>";
                
                echo "<div class='article-content'>";

                echo "<a class='article-image'>";
                if ($article["image"]) {
                    $image_path = "images/products/{$article["image"]}";

                    if (file_exists($image_path)) {
                        echo "<img src='/{$image_path}' loading='lazy'>";
                    } else {
                        echo "<img src='/images/products/not-found.jpg' loading='lazy'>";
                    }
                } else {
                    echo "<img src='/images/products/not-found.jpg' loading='lazy'>";
                }
                echo "</a>";

                echo '<p>' . $article['description'] . '</p>';

                echo "<div class='article-reservation'>";
                echo "<form method='post'>";
                echo "<button class='submit-button product-reservation' type='submit' name='winkelwagen-toevoegen'>Aan winkelwagen toevoegen</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                ?>
            </div>
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
</body>
</html>
