<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if(isset($_GET['query'])) {
    // Get the search term from the form
    $searchTerm = $_GET['query'];
    
    // SQL query to search for data
<<<<<<< Updated upstream
    $sql = "SELECT * FROM PRODUCTEN WHERE naam LIKE '%$searchTerm%'";
=======
    $sql = "SELECT * FROM PRODUCTS WHERE name LIKE '%$searchTerm%'";
>>>>>>> Stashed changes
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if any results were found
    if ($result->num_rows > 0) {
        // Start session
        session_start();

        // Store search results in session variable
        $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);

        // Redirect to index.php
        header("Location: gezochte_producten.php?query=$searchTerm");
        exit();
    } else {
        // No results found, redirect with a flag
        header("Location: gezochte_producten.php?query=$searchTerm&no_results=true");
        exit();
    }
}
?>