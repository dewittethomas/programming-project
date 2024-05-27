<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'db_connection.php';

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

<main class="container">
    <h1>Winkelmandje</h1>
    <div class="selected-products">
        <?php 
        // Check if any products are selected
        if (!empty($_SESSION['selected_products'])) {
            // Loop through each selected product
            foreach ($_SESSION['selected_products'] as $product) {
                echo '<div class="product">';
                echo '<h2>' . $product['product_naam'] . '</h2>';
                echo '<p>Start Date: ' . $product['start_date'] . '</p>';
                echo '<p>End Date: ' . $product['end_date'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No products selected.</p>';
        }
        ?>
    </div>
    
    <!-- Form to confirm and insert all selected products into the database -->
    <form action="" method="post">
        <button type="submit" name="confirm_reservation">Bevestig Reservering</button>
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
            $product_naam = $product['product_naam'];
            $start_date = $product['start_date'];
            $end_date = $product['end_date'];

            // Prepare and execute the SQL statement to insert reservation
            $sql = "INSERT INTO RESERVERINGEN (product_id, product_naam, start_date, end_date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $product_id, $product_naam, $start_date, $end_date);
            $stmt->execute();
        }

        // Commit the transaction
        $conn->commit();

        // Clear the selected products session array
        $_SESSION['selected_products'] = array();

        // Redirect to a success page or wherever you need to go next
        header("Location: success.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
