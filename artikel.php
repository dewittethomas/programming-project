<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'db_connection.php';

// Retrieve product information based on the product ID passed through the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to fetch product information based on ID
    $sql = "SELECT * FROM PRODUCTEN WHERE id = $product_id"; // Change this to your table name and column names
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_naam = $row['naam'];
        // You can retrieve other product information here as well
    } else {
        $product_naam = "Product not found";
    }
} else {
    $product_naam = "Product ID not provided";
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        /* Main styling */

/* Colors */
@import url("colors.css");

/* Reset defaults */
@import url("reset.css");

/* General */

body {
    font-family: Poppins, sans-serif;
    background-color: var(--white);
    color: var(--black);
}

header {
    width: 100%;
}

.header-top {
    width: 100%;
    border-bottom: 1px solid var(--grey);
}

.header-bottom {
    width: 100%;
    border-bottom: 1px solid var(--grey);
    background-color: var(--light-grey);
}

.container {
    margin: auto;
    padding: 0 2.2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    margin: 0.8rem 0;
    display: flex;
    align-items: center;
}

nav {
    display: flex;
    align-items: center;
}

.cart {
    width: 2.2rem;
    height: 2.2rem;
}

.search-container {
    display: flex;
    justify-content: center;
    flex-grow: 1;
}

input {
    padding: 1rem 1rem 1rem 3rem;
    width: 70%;
    height: 45px;
    border: 1px solid var(--grey);
    border-radius: 9px;
    box-shadow: 1px 1px 10px var(--grey);
    background-image: url("/images/search.svg");
    background-repeat: no-repeat;
    background-position: 1rem;
    background-size: 1rem 1rem;
}

input:focus {
    border: 1px solid var(--blue);
}

.category-container {
    width: 80%;
    margin: 1rem auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.category-container li {
    font-size: 1.1rem;
    font-weight: 700;
}
.container {
    margin: auto;
    padding: 0 2.2rem;
    display: flex;
    align-items: flex-start; /* Align items vertically at the start */
    justify-content: space-between; /* Distribute space between items */
}

.item {
    width: 30%; /* Adjust width as needed */
    margin-right: 2rem; /* Add spacing between items */
}

.item img {
    max-width: 100%; /* Ensure image does not exceed container width */
}

.NaamProductFoto {
    font-size: large;
    font-weight: bold;
    text-transform: uppercase;
}

.Beschrijving {
    width: 60%; /* Adjust width as needed */
}

/* CSS for rounded corners and styling of dates */

.calendar caption {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 10px;
}

table{
            width: 100%; /* Adjust width as needed */
            border-collapse: collapse;
            border-radius: 10px; /* Add rounded corners */
            color: blue;
            border: 1px solid black;
        }
        th{
            width: 100px;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            border: 1px solid black;
        }
        td{
            width: 100px;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            border: 1px solid black;
        }
        .calendar td > * {
            width: 100%; /* Make child elements fill the entire width */
            height: 100%; /* Make child elements fill the entire height */
            box-sizing: border-box; /* Include padding and border in the width calculation */
        }

.empty {
    background-color: black;
}

input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none; /* Prevent interaction with hidden checkboxes */
        }
        .selected {
            background-color: black;
            color: white; /* Change text color to white for better contrast */
        }

       

.calendar .fade {
    color: #aaa; /* Change to the desired color for faded dates */
    pointer-events: none; /* Disable pointer events for faded dates */
}


.header {
    background-color: #ccc;
}

.empty {
    background-color: #f2f2f2;
}
.capitalize{
    text-transform: uppercase;
    font-weight: bold;


}
.red {
    background-color: red;
    color: white;
}

.gray {
    background-color: gray;
    color: white;
}
.blue {
    background-color: blue;
    color: white; /* Change text color to white for better contrast */
}

    </style>
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
        <p class="NaamProductFoto"><?php echo $product_naam; ?></p>
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


</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.date-checkbox');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const selectedDatesContainer = document.getElementById('selected-dates');
            const selectedDates = document.querySelectorAll('.date-checkbox:checked');
            const datesArray = Array.from(selectedDates).map(function(date) {
                return date.value;
            });
            selectedDatesContainer.textContent = 'Selected dates: ' + datesArray.join(', ');

            // Disable all checkboxes if more than two are selected
            checkboxes.forEach(function(cb) {
                cb.disabled = (selectedDates.length >= 2 && !cb.checked);
            });
        });
    });

    // Event listener for previous month button
    document.getElementById('prev-month').addEventListener('click', function() {
        changeMonth(-1);
    });

    // Event listener for next month button
    document.getElementById('next-month').addEventListener('click', function() {
        changeMonth(1);
    });

   // Attach click event listener to the entire calendar table
document.querySelector('.calendar').addEventListener('click', function(event) {
    // Check if the clicked element is a cell with a date-checkbox or any of its child elements
    const cell = event.target.closest('td');
    if (cell && cell.querySelector('.date-checkbox')) {
        toggleSelection(cell);
    }
});

});

// Function to change the month dynamically
function changeMonth(offset) {
    const currentMonth = parseInt(document.getElementById('current-month').value);
    const currentYear = parseInt(document.getElementById('current-year').value);
    let newMonth = currentMonth + offset;
    let newYear = currentYear;

    if (newMonth < 1) {
        newMonth = 12;
        newYear--;
    } else if (newMonth > 12) {
        newMonth = 1;
        newYear++;
    }

    // Call AJAX function to fetch and display the calendar for the new month
    fetchCalendar(newMonth, newYear);
}

// Function to fetch and display the calendar for a specific month and year using AJAX
function fetchCalendar(month, year) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const calendarContainer = document.getElementById('calendar-container');
                // Replace the inner HTML of the calendar container with the new calendar
                calendarContainer.innerHTML = xhr.responseText;
                // Update the hidden inputs for the current month and year
                document.getElementById('current-month').value = month;
                document.getElementById('current-year').value = year;
            } else {
                console.error('Error fetching calendar: ' + xhr.status);
            }
        }
    };
    xhr.open('GET', 'calendar.php?month=' + month + '&year=' + year, true);
    xhr.send();
}

// Function to toggle the selection of a calendar cell
function toggleSelection(cell) {
    const checkbox = cell.querySelector('.date-checkbox');
    checkbox.checked = !checkbox.checked;
    cell.classList.toggle('selected', checkbox.checked);
}
document.addEventListener('DOMContentLoaded', function() {
    const dateCells = document.querySelectorAll('.calendar td:not(.empty)');
    
    dateCells.forEach(function(cell) {
        cell.addEventListener('click', function() {
            // Select all date cells
            dateCells.forEach(function(dateCell) {
                dateCell.classList.add('selected');
            });
        });
    });
});





</script>