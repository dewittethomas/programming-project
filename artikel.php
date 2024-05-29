<?php
session_start();

require 'includes/products.php';
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'includes/connect.php';

// Initialize an empty array to store selected products if not already initialized
if (!isset($_SESSION['selected_products'])) {
    $_SESSION['selected_products'] = array();
}

// Retrieve product information based on the product ID passed through the URL
$product_naam = $product_description = $product_image = "";
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
        $product_description = $row['description'];
        $product_image = 'images/'. $row['image'];
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

<main class="container">
    <div class="item">
    <p class="NaamProductFoto"><?php echo htmlspecialchars($product_naam); ?> </p>
        
    <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product_naam); ?>">
     
   
    </div>
    
    <div>
        <!-- Calendar form -->
        <form action="artikel.php" method="post">
            <p>beschikbaarheid:</p>
            <input type="date" id="start_date" name="start_date" required>
            
            <!-- Hidden end date field -->
            <input type="hidden" id="end_date" name="end_date">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="product_naam" value="<?php echo htmlspecialchars($product_naam); ?>">
            <!-- Reserveren button -->
            <br>
            <button type="submit" name="reserveren">Reserveren</button>
        </form>
    </div>
    <div>
        <p class="Beschrijving"> <span class="capitalize"> Beschrijving van product </span> <br> <br> <?php echo nl2br(htmlspecialchars($product_description)); ?></p>
    </div>
    <?php 
    // Display success message if redirected with success parameter
    if(isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<p>Product succesvol toegevoegd aan winkelmandje!</p>';
    }
    ?>
</main>

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

        // Calculate the start and end of the current week
        const currentWeekStart = new Date();
        currentWeekStart.setDate(currentWeekStart.getDate() - currentWeekStart.getDay() + 1); // Monday

        const currentWeekEnd = new Date(currentWeekStart);
        currentWeekEnd.setDate(currentWeekStart.getDate() + 4); // Friday

        // Normalize the selected date to week start and end
        const selectedWeekStart = new Date(selectedDate);
        selectedWeekStart.setDate(selectedDate.getDate() - selectedDate.getDay() + 1); // Monday

        const selectedWeekEnd = new Date(selectedWeekStart);
        selectedWeekEnd.setDate(selectedWeekStart.getDate() + 4); // Friday

        // Disable weekends and reserved weeks
        return selectedDate.getDay() === 0 || selectedDate.getDay() === 6 || reservedWeeks.some(week => {
            const weekStart = new Date(week.week_start);
            const weekEnd = new Date(week.week_end);
            return (selectedWeekStart <= weekEnd && selectedWeekEnd >= weekStart);
        }) || (selectedWeekStart <= currentWeekEnd && selectedWeekEnd >= currentWeekStart);
    }

    flatpickr("#start_date", {
        minDate: "today",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                return disableReservedWeeks(date);
            }
        ],
        locale: {
            firstDayOfWeek: 1 // Start the week on Monday
        },
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
