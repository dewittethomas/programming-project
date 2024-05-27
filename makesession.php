<?php
session_start();

// Initialize an empty array to store selected products if not already initialized
if (!isset($_SESSION['selected_products'])) {
    $_SESSION['selected_products'] = array();
}

// Handle form submission and store selected dates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserveren'])) {
    // Check if start and end dates are submitted
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        // Retrieve product information based on the product ID passed through the URL
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // Include the database connection file
            include 'db_connection.php';

            // Query to fetch product information based on ID
            $sql = "SELECT * FROM PRODUCTEN WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $product_naam = $row['naam'];

                // Store the selected product and dates in the session array
                $_SESSION['selected_products'][] = array(
                    'product_id' => $product_id,
                    'product_naam' => $product_naam,
                    'start_date' => $_POST['start_date'],
                    'end_date' => $_POST['end_date']
                );

                // Redirect to artikel.php with a success message
                header("Location: winkelmandje.php?id=$product_id&success=true");
                exit();
            } else {
                // Handle the case where product is not found
                echo '<p>Product not found.</p>';
            }
            $stmt->close();
        }
    } else {
        // Handle the case where dates are not provided
        echo '<p>Startdatum en einddatum zijn vereist.</p>';
    }
}
?>
