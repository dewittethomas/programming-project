<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservatie Gelukt</title>
    <link rel="stylesheet" href="styles/main.css">
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
                    
                    <li><a href="gezochte_producten.php?category=Audio">Audio</a></li>
        <li><a href="gezochte_producten.php?category=Belichting">Belichting</a></li>
        <li><a href="gezochte_producten.php?category=Tools">Tools</a></li>
        <li><a href="gezochte_producten.php?category=Varia">Varia</a></li>
        <li><a href="gezochte_producten.php?category=XR">XR</a></li>
  
                </ul>
            </div>
        </div>
    </header>
<main>
    <h1>Reservatie Gelukt!</h1>
    <p>Hier zijn de details van uw reservering:</p>
    <div class="row">
        <?php 
        // Check if any products are selected
        if (!empty($_SESSION['selected_products'])) {
            // Loop through each selected product
            foreach ($_SESSION['selected_products'] as $product) {
                echo '<div class="product-item">';
                echo '<img src="38088.avif">';
                echo '<div class="details">';
                echo '<h2 class="capitalize">' . $product['product_naam'] . '</h2>';
                echo '<p>Termijn: ' . $product['start_date'] . ' - ' . $product['end_date'] . '</p>';
                echo '</div>';
                echo '</div>';
                
            }
        } else {
            echo '<p>No products selected.</p>';
        }
        echo '<p>Je kan deze artikels afhalen in het MediaLab tijdens de openingsuren. Spreek hiervoor een medewerker aan. Zorg zeker
        dat je je studentenkaart bij hebt.</p>'
        ?>
    </div>
</main>
<footer>
    <p>&copy; Erasmushogeschool Brussel 2024</p>
</footer>
</body>
</html>
<?php
// Clear the selected products session array
$_SESSION['selected_products'] = array();
?>