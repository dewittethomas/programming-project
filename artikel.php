<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/connect.php';

if (!isset($_SESSION['selected_products'])) {
    $_SESSION['selected_products'] = array();
}

$product_naam = $product_description = "";
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM PRODUCTS WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_naam = $row['name'];
        $product_description = $row['description'];
    } else {
        $product_naam = "Product not found";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Uitleendienst MediaLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="images/website/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<header>
    <div class="header-top">
        <div class="container">
            <a class="logo" href="index.php" title="Home">
                <img src="/images/website/logo.svg" alt="Home">
            </a>
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search...">
            </form>
            <nav><a href="winkelmand.php">
                <img class="cart" src="images/website/shopping-cart.svg">
                </a>
            </nav>
        </div>
    </div>
</header>

<main class="container">
    <div class="item">
    <p class="NaamProductFoto"><?php echo htmlspecialchars($product_naam); ?></p>
        <img src="38088.avif" alt="">
        
    </div>
    
    <div>
        <form action="artikel.php" method="post">
            <p>beschikbaarheid:</p>
            <input type="date" id="start_date" name="start_date" required>
            
            <input type="hidden" id="end_date" name="end_date">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="product_naam" value="<?php echo htmlspecialchars($product_naam); ?>">
            <br>
            <button type="submit" name="reserveren">Reserveren</button>
        </form>
    </div>
    <div>
        <p class="Beschrijving"> <span class="capitalize"> Beschrijving van product </span> <br> <br> <?php echo nl2br(htmlspecialchars($product_description)); ?></p>
    </div>
    <?php 
    if(isset($_GET['success']) && $_GET['success'] == 'true') {
        echo '<p>Product succesvol toegevoegd aan winkelmandje!</p>';
    }
    ?>
</main>

<footer>
    <p>&copy; Erasmushogeschool Brussel 2024</p>
</footer>

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
