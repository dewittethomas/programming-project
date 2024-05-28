<?php
session_start();
include 'db_connection.php';

if (isset($_POST['product_key'])) {
    $key = $_POST['product_key'];
    $product_id = $_SESSION['selected_products'][$key]['product_id'];
    $product_name = $_SESSION['selected_products'][$key]['product_naam'];

    // Query to count available products with the same name
    $availability_query = "SELECT COUNT(*) AS available_count 
                           FROM PRODUCTEN 
                           WHERE name = ? AND availability = 1";
    $stmt = $conn->prepare($availability_query);
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Check if there are available products
    if ($product['available_count'] > 0) {
        // If available, increase the quantity
        $_SESSION['selected_products'][$key]['quantity']++;
        // Return a success response
        echo json_encode(['status' => 'success']);
    } else {
        // Return a failure response
        echo json_encode(['status' => 'failure', 'message' => 'Product is not available']);
    }
}
?>
