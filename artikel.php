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
    $sql = "SELECT * FROM PRODUCTS WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_naam = $row['name'];
    } else {
        $product_naam = "Product not found";
    }
    $stmt->close();
}

// Fetch existing reservations for the product to disable conflicting dates
$reservations = [];
$sql = "SELECT begindatum, einddatum FROM RESERVERINGEN WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $reservations[] = [
        'begindatum' => $row['begindatum'],
        'einddatum' => $row['einddatum']
    ];
}
$stmt->close();

function getReservedWeeks($reservations) {
    $reserved_weeks = [];
    foreach ($reservations as $reservation) {
        $start = new DateTime($reservation['begindatum']);
        $end = new DateTime($reservation['einddatum']);
        
        // Normalize the start to Monday
        $start->modify('Monday this week');
        
        // Normalize the end to Friday
        $end->modify('Friday this week');
        
        while ($start <= $end) {
            $week_start = clone $start;
            $week_end = clone $start;
            $week_end->modify('Friday this week');
            
            $reserved_weeks[] = [
                'week_start' => $week_start->format('Y-m-d'),
                'week_end' => $week_end->format('Y-m-d')
            ];
            
            $start->modify('+1 week');
        }
    }
    return $reserved_weeks;
}

$reserved_weeks = getReservedWeeks($reservations);

// Handle form submission and store selected dates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserveren'])) {
    // Check if start date is submitted
    if (isset($_POST['start_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = date('Y-m-d', strtotime($start_date . ' + 4 days'));
        
        // Retrieve product ID and name from the form submission
        $product_id = $_POST['product_id'];
        $product_naam = $_POST['product_naam'];

        // Store the selected product and dates in the session array
        $_SESSION['selected_products'][] = array(
            'product_id' => $product_id,
            'product_naam' => $product_naam,
            'start_date' => $start_date,
            'end_date' => $end_date,
        );

        // Redirect to artikel.php with a success message
        header("Location: artikel.php?id=$product_id&success=true");
        exit();
    } else {
        // Handle the case where start date is not provided
        echo '<p>Startdatum is vereist.</p>';
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <!-- Include flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<header>
    <div class="header-top">
        <div class="container">
            <a class="logo" href="index.php" title="Home">
                <img src="/images/logo.svg" alt="Home">
            </a>
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search...">
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
        <form action="artikel.php" method="post">
            <label for="start_date">Startdatum:</label>
            <input type="date" id="start_date" name="start_date" required>
            
            <!-- Hidden end date field -->
            <input type="hidden" id="end_date" name="end_date">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="product_naam" value="<?php echo $product_naam; ?>">
            <!-- Reserveren button -->
            <button type="submit" name="reserveren">Reserveren</button>
        </form>
    </div>
    <div>
        <p class="Beschrijving"> <span class="capitalize"> Beschrijving van product </span> <br> <br> De Nikon D50 is een semiprofessionele spiegelreflexcamera. De D50 levert foto's af in JPEG- en RAW-formaat. De D50 kan uitgebreid worden met een heel gamma aan Nikkor-lenzen.</p>
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

<!-- Include flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reservedWeeks = <?php echo json_encode($reserved_weeks); ?>;

    function disableReservedWeeks(date) {
        const selectedDate = new Date(date);
        const selectedWeekStart = new Date(selectedDate);
        selectedWeekStart.setDate(selectedDate.getDate() - selectedDate.getDay() + 1); // Monday

        const selectedWeekEnd = new Date(selectedWeekStart);
        selectedWeekEnd.setDate(selectedWeekStart.getDate() + 4); // Friday

        return reservedWeeks.some(week => {
            const weekStart = new Date(week.week_start);
            const weekEnd = new Date(week.week_end);
            return (selectedWeekStart <= weekEnd && selectedWeekEnd >= weekStart);
        });
    }

    flatpickr("#start_date", {
        minDate: "today",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                return disableReservedWeeks(date);
            }
        ],
        onChange: function(selectedDates, dateStr, instance) {
            const startDate = new Date(dateStr);
            const endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + 4);
            document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
        }
    });
});
</script>
</body>
</html>
