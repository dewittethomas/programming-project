<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Include the database connection file
include 'db_connection.php';

// Query to fetch products
$sql = "SELECT * FROM PRODUCTEN"; // Change this to your table name
$result = $conn->query($sql);

// Display products
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Create a clickable link for each product name
        echo "<a href='artikel.php?id=" . $row["id"] . "'>" . $row["naam"] . "</a><br>";
        // You can format the output as HTML as needed
    }
} else {
    echo "No products found.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>