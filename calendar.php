<?php
// Function to generate a calendar for a specific month and year
function generateCalendar($month, $year) {
    // Get the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // Get the number of days in the month
    $numDays = date('t', $firstDayOfMonth);

    // Start the table
    echo '<table class="calendar">';
    echo '<caption>' . date('F Y', $firstDayOfMonth) . '</caption>';
    echo '<tr>';
    echo '<th>ma</th><th>di</th><th>wo</th><th>do</th><th>vr</th><th>za</th><th>zo</th>';
    echo '</tr>';

    // Start the first row
    echo '<tr>';

    // Fill in the blank cells before the first day of the month
    for ($i = 1; $i < date('N', $firstDayOfMonth); $i++) {
        echo '<td class="empty"></td>';
    }

    // Loop through the days of the month
    for ($day = 1; $day <= $numDays; $day++) {
        // Start a new row if it's a Monday
        if (date('N', mktime(0, 0, 0, $month, $day, $year)) == 1) {
            echo '</tr><tr>';
        }

        // Output the day in a table cell with a checkbox
        echo '<td>';
        echo '<label><input type="checkbox" class="date-checkbox" name="selected_dates[]" value="' . date('Y-m-d', mktime(0, 0, 0, $month, $day, $year)) . '">';
        echo $day . '</label>';
        echo '</td>';
    }

    // Fill in the remaining cells in the last row
    for ($i = date('N', mktime(0, 0, 0, $month, $numDays, $year)); $i < 7; $i++) {
        echo '<td class="empty"></td>';
    }

    // Close the table
    echo '</tr>';
    echo '</table>';
}

// Display the calendar for the current month
generateCalendar(date('n'), date('Y'));
?>