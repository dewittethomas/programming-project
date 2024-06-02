<?php
    require 'includes/session.php';
    require 'includes/products.php';
    require 'includes/categories.php';
    require 'includes/pages.php';

    $total_pages = getPages($category, $subcategory);

    if ($total_pages < $current_page) {
        header("Location: index.php?page={$total_pages}");
        exit;
    } elseif ($current_page <= 0) {
        header("Location: index.php");
        exit;
    }
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
                        <li class="dropdown-item <?php echo ($category == 1) ? 'current-category' : ''; ?>"><a href="/index.php?category=1">Video</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);
                                    
                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 1) {
                                            echo "<a href='/index.php?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
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
                        <li class="dropdown-item <?php echo ($category == 2) ? 'current-category' : ''; ?>"><a href="/index.php?category=2">Audio</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 2) {
                                            echo "<a href='/index.php?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
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
                        <li class="dropdown-item <?php echo ($category == 3) ? 'current-category' : ''; ?>"><a href="/index.php?category=3">Belichting</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 3) {
                                            echo "<a href='/index.php?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
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
                        <li class="dropdown-item <?php echo ($category == 4) ? 'current-category' : ''; ?>"><a href="/index.php?category=4">Tools</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 4) {
                                            echo "<a href='/index.php?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
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
                        <li class="dropdown-item <?php echo ($category == 5) ? 'current-category' : ''; ?>"><a href="/index.php?category=5">Varia</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 5) {
                                            echo "<a href='/index.php?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
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
                        <li class="dropdown-item <?php echo ($category == 6) ? 'current-category' : ''; ?>"><a href="/index.php?category=6">XR</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <?php
                                    mysqli_data_seek($categories, 0);

                                    while($row = mysqli_fetch_assoc($categories)) {
                                        if ($row["category"] == 6) {
                                            echo "<a href='/index.php?category={$row["category"]}&subcategory={$row["subcategory_id"]}'";
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
            <div class="product-container">
                <?php
                $products = getProducts($start, 10, $category, $subcategory);
                
                while($row = mysqli_fetch_assoc($products)) {
                    if ($row["brand"]) {
                        $product = getProductDetails($row["name"], $row["brand"]);
                    } else {
                        $product = getProductDetails($row["name"]);
                    }
                        
                    while($row = mysqli_fetch_assoc($product)) {
                        echo '<div class="product">';

                        echo "<a class='product-image' href='artikel.php'>";
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
                        echo "</a>";
    
                        echo "<div class='product-information'>";
                        echo "<a class='product-title' href='artikel.php'>{$row["name"]}</a>";

                        if ($row["brand"]) {
                            echo "<a class='product-subtitle'>{$row["brand"]} | {$row["object"]}</a>";
                        } else {
                            echo "<a class='product-subtitle'>Geen merk | {$row["object"]}</a>";
                        }
                        
                        echo "<p>{$row["description"]}</p>";
                        echo "<div class='product-footer'>";
                        
                        $count = isAvailable($row["name"]);
                        echo "<p class='product-availability'>{$count} Beschikbaar</p>";

                        if ($count) {
                            echo "<button class='submit-button product-reservation available'>Reserveren</button>";
                        } else {
                            echo "<button class='submit-button product-reservation unavailable'>Reserveren</button>";
                        }
                        
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>

        <div class="container">
            <div class="pages-container">
            <?php
            if ($current_page != 1) {
                echo "<a class='arrow-icon' href='/index.php?page=" . ($current_page - 1);
                if ($category) {
                    echo "&category=" . urlencode($category);
                }
                if ($subcategory) {
                    echo "&subcategory=" . urlencode($subcategory);
                }
                echo "'>";
                echo "<img src='/images/website/arrow-left.svg' loading='lazy'>";
                echo "</a>";
            }
            ?>

            <div class="pages">
            <?php
            echo "<a href='index.php?page=1";
            if ($category) {
                echo "&category=" . urlencode($category);
            }
            if ($subcategory) {
                echo "&subcategory=" . urlencode($subcategory);
            }
            echo "'";
            if (1 == $current_page) {
                echo " class='current-page'";
            }
            echo ">1</a>";

            if ($current_page <= 4) {
                $start_page = 2;
                $end_page = min(5, $total_pages - 1);
            } elseif ($current_page >= $total_pages - 3) {
                $start_page = max($total_pages - 4, 2);
                $end_page = $total_pages - 1;
            } else {
                $start_page = $current_page - 2;
                $end_page = $current_page + 2;
            }

            if ($start_page > 2) {
                echo "<span>...</span>";
            }

            for ($i = $start_page; $i <= $end_page; $i++) {
                echo "<a href='index.php?page={$i}";
                if ($category) {
                    echo "&category=" . urlencode($category);
                }
                if ($subcategory) {
                    echo "&subcategory=" . urlencode($subcategory);
                }
                echo "'";
                if ($i == $current_page) {
                    echo " class='current-page'";
                }
                echo ">{$i}</a>";
            }

            if ($end_page < $total_pages - 1) {
                echo "<span>...</span>";
            }

            if ($total_pages > 1) {
                echo "<a href='index.php?page={$total_pages}";
                if ($category) {
                    echo "&category=" . urlencode($category);
                }
                if ($subcategory) {
                    echo "&subcategory=" . urlencode($subcategory);
                }
                echo "'";
                if ($total_pages == $current_page) {
                    echo " class='current-page'";
                }
                echo ">{$total_pages}</a>";
            }
            ?>
            </div>

            <?php
            if ($current_page != $total_pages) {
                echo "<a class='arrow-icon' href='/index.php?page=" . ($current_page + 1);
                if ($category) {
                    echo "&category=" . urlencode($category);
                }
                if ($subcategory) {
                    echo "&subcategory=" . urlencode($subcategory);
                }
                echo "'>";
                echo "<img src='/images/website/arrow-right.svg' loading='lazy'>";
                echo "</a>";
            }
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