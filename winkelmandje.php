<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database connection file
include 'includes/connect.php';

// Initialize an empty array to store selected products if not already initialized
if (!isset($_SESSION['selected_products'])) {
    $_SESSION['selected_products'] = array();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelmandje</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        /* Additional styling specific to winkelmandje.php can be added here */
    </style>
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
    <h1>Reservatie</h1>
    <div class="row">
        <?php 
        // Check if any products are selected
        if (!empty($_SESSION['selected_products'])) {
            // Loop through each selected product
            foreach ($_SESSION['selected_products'] as $key => $product) {
                echo '<div class="product-item">';
                echo '<img src="38088.avif">';
                echo '<div class="details">';
                echo '<h2 class="capitalize">' . $product['product_naam'] . '</h2>';
                echo '<p>Termijn: ' . $product['start_date'] . ' - ' . $product['end_date'] . '</p>';
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="remove_product_key" value="' . $key . '">';
                echo '<button type="submit" name="remove_product" class="verwijderen-button">Verwijderen</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No products selected.</p>';
        }
        ?>
    </div>
    
    <!-- Form to confirm and insert all selected products into the database -->
    <form action="" method="post" class="reserveren-form">
        <button type="submit" name="confirm_reservation" class="reserveren-button">Reserveren</button>
    </form>
</main>

<footer>
    <p>&copy; Erasmushogeschool Brussel 2024</p>
</footer>

</body>
</html>


<?php
// Check if the confirm_reservation button is clicked
if (isset($_POST['confirm_reservation'])) {
    // Begin a database transaction
    $conn->begin_transaction();

    try {
        // Iterate through each selected product and insert it into the database
        foreach ($_SESSION['selected_products'] as $product) {
            $product_id = $product['product_id'];
            $start_date = $product['start_date'];
            $end_date = $product['end_date'];

            $user_id = 500; // Assign the user_id variable the value of 500

            // Prepare and execute the SQL statement to insert reservation
            $sql = "INSERT INTO RESERVERINGEN (product_id, user_id, begindatum, einddatum) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiss", $product_id, $user_id, $start_date, $end_date);
            $stmt->execute();
        }

        // Commit the transaction
        $conn->commit();

        // Redirect to a success page or wherever you need to go next
        header("Location: reservatiegelukt.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Check if the remove_product button is clicked
if (isset($_POST['remove_product'])) {
    // Get the key of the product to remove from the session
    $key = $_POST['remove_product_key'];
    // Remove the product from the session using the key
    unset($_SESSION['selected_products'][$key]);
    // Redirect to refresh the page
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>
