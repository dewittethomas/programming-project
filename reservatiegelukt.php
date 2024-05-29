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
            <a class="logo" href="index.php" title="Home">
                <img src="/images/logo.svg" alt="Home">
            </a>
            <form action="search.php" method="GET">
                <input type="text" name="query"  placeholder="Search...">
            </form>
            <nav>
                <img class="cart" src="images/shopping-cart.svg">
            </nav>
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