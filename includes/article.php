<?php
    require 'includes/connect.php';
    require 'includes/products.php';

    if (!isset($_GET['name'])) {
        header("Location: /");
        exit;
    }

    $name = urldecode($_GET['name']);
    $brand = urldecode($_GET['brand']);

    $information = getProductDetails($name, $brand);
    $article = mysqli_fetch_assoc($information);

    $timestamp = time();

    $current_day = date('D');

    if ($current_day == 'Mon') {
        $start_date = date('Y-m-d');
    } else {
        // Get the timestamp for next Monday
        $next_monday_timestamp = strtotime('next Monday');

        // Check if today is Friday or Saturday
        if ($current_day == 'Fri' || $current_day == 'Sat') {
            // If today is Friday or Saturday, set the start date to the Monday after next
            $start_date = date('Y-m-d', strtotime('next Monday', $next_monday_timestamp));
        } else {
            // If today is any other day, set the start date to the next Monday
            $start_date = date('Y-m-d', $next_monday_timestamp);
        }
    }

    // Set the end date to 5 days after the start date
    $end_date = date('Y-m-d', strtotime($start_date . ' + 4 days'));

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['winkelwagen-toevoegen'])) {
        $query = "SELECT id FROM PRODUCTS WHERE name = ? AND brand = ? AND availability = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $name, $brand);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($product_id);
            $stmt->fetch();
    
            addToCart($product_id, $start_date, $end_date);
        }

        header("Location: /");
        exit;
    }

    function addToCart($product_id, $start_date, $end_date) {
        // Implement the logic to add the product to the cart
        // This might include inserting the product ID into a session or a database table
    
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
    }
?>