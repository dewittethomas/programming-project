<?php
<<<<<<< Updated upstream

function confirmReservation() {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include the database connection file
    include 'db_connection.php';

    // Assign the user_id variable the value of 12
    $user_id = 500;

    // Initialize variables to store selected dates
    $selected_dates = [];
    $begindatum = "";
    $einddatum = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_reservation'])) {
        $selected_dates = $_POST['selected_dates'];
        // Assuming you have two selected dates and you want to store them in separate variables
        if (count($selected_dates) >= 2) {
            // Assign the selected dates to variables
            $begindatum = date('Y-m-d', strtotime($selected_dates[0]));
            $einddatum = date('Y-m-d', strtotime($selected_dates[1]));
        }
        // Prepare and execute the SQL statement to insert reservation
        $sql = "INSERT INTO RESERVERINGEN (product_id, user_id, begindatum, einddatum) 
        VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and ensure dates are not empty before inserting
            $stmt->bind_param("iiss", $product_id, $user_id, $begindatum, $einddatum);
            if ($begindatum !== "" && $einddatum !== "" && $stmt->execute()) {
                echo "Reservation successfully inserted.";
            } else {
                echo "Error: " . $stmt->error; // Provide more detailed error message
            }
            $stmt->close();
        } else {
            echo "Error preparing SQL statement: " . $conn->error;
        }
    }
}
=======
include 'db_connection.php';
>>>>>>> Stashed changes

?> 