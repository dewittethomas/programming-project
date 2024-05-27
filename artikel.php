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

// Retrieve product information based on the product ID passed through the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to fetch product information based on ID
    $sql = "SELECT * FROM PRODUCTEN WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_naam = $row['naam'];
    } else {
        $product_naam = "Product not found";
    }
    $stmt->close();
}

// Handle form submission and store selected dates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserveren'])) {
    // Check if start and end dates are submitted
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Store the selected product and dates in the session array
        $_SESSION['selected_products'][] = array(
            'product_id' => $product_id,
            'product_naam' => $product_naam,
            'start_date' => $start_date,
            'end_date' => $end_date
        );

        // Redirect to artikel.php with a success message
        header("Location: artikel.php?id=$product_id&success=true");
        exit();
    } else {
        // Handle the case where dates are not provided
        echo '<p>Startdatum en einddatum zijn vereist.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Uitleendienst MediaLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
    <div class="item">
        <img src="38088.avif" alt="">
        <p class="NaamProductFoto"><?php echo $product_naam; ?></p>
    </div>
    <div>
        <!-- Calendar form -->
        <form action="artikel.php?id=<?php echo $product_id; ?>" method="post">
            <label for="start_date">Begindatum:</label>
            <input type="date" id="start_date" name="start_date" required>
            
            <label for="end_date">Einddatum:</label>
            <input type="date" id="end_date" name="end_date" required>
            
            <!-- Reserveren button -->
            <button type="submit" name="reserveren">Reserveren</button>
        </form>
    </div>
    <div>
        <p class="Beschrijving"> <span class="capitalize"> Beschrijving van pruduct </span> <br> <br> De Nikon D50 is een semiprofessionele spiegelreflexcamera. De D50 levert foto's af in JPEG- en RAW-formaat. De D50 kan uitgebreid worden met een heel gamma aan Nikkor-lenzen.</p>
    </div>
    <?php 
    // Display success message if redirected with success parameter
    if(isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<p>Product succesvol toegevoegd aan winkelmandje!</p>';
    }
    ?>
</main>

<div>
    <p>Gerelateerde producten</p>
</div>
<footer>
    <p>&copy; Erasmushogeschool Brussel 2024</p>
</footer>

</body>
</html>
