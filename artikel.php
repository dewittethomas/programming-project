<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Your PHP code goes here
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
            <a class="logo" href="#" title="Home">
                <img src="/images/logo.svg" alt="Home">
            </a>
            <form class="search-container" action="/">
                <input type="text" placeholder="Search...">
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
        <p class="NaamProductFoto">Nikon d50</p>
    </div>
    <div>
        <?php
        // Handle form submission and store selected dates
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserveren'])) {
            // Check if selected dates are submitted
            if (isset($_POST['selected_dates'])) {
                // Store selected dates in an array
                $selected_dates = $_POST['selected_dates'];

                // Display the selected dates
                if (count($selected_dates) > 0) {
                    echo '<p>Selected dates:</p>';
                    echo '<ul>';
                    foreach ($selected_dates as $date) {
                        echo '<li>' . $date . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No dates selected.</p>';
                }
            } else {
                echo '<p>No dates selected.</p>';
            }
        }
        ?>

        <!-- Calendar form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <!-- Calendar container -->
                <?php include 'calendar.php'; ?>
            </div>
            <!-- Reserveren button -->
            <button type="submit" name="reserveren">Reserveren</button>
        </form>

    </div>
    <div>
        <p class="Beschrijving"> <span class="capitalize"> Beschrijving van pruduct </span> <br> <br> De Nikon D50 is een semiprofessionele spiegelreflexcamera. De D50 levert foto's af in JPEG- en RAW-formaat. De D50 kan uitgebreid worden met een heel gamma aan Nikkor-lenzen.</p>
    <div>

    </div>
    </div>

    <!-- Container to display selected dates -->
    <div id="selected-dates"></div>

    <!-- Hidden inputs to store current month and year -->
    <input type="hidden" id="current-month" value="<?php echo date('n'); ?>">
    <input type="hidden" id="current-year" value="<?php echo date('Y'); ?>">

    <!-- Navigation buttons for previous and next months -->
    <div>
        <button id="prev-month">Previous Month</button>
        <button id="next-month">Next Month</button>
    </div>

    <!-- Container for dynamically loaded calendar -->
    <div id="calendar-container"></div>

</main>

<div class="">
    <p>Gerelateerde producten</p>
</div>
<footer>
    <p>&copy; Erasmushogeschool Brussel 2024</p>
</footer>

<script src="javascript.js" >  </script>
</body>
</html>
