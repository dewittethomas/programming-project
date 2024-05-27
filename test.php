<?php

function generateCalendar($start, $end) {
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    $endDate->modify('+1 day'); // Add one day to include the end date
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($startDate, $interval, $endDate);

    $calendar = [];
    foreach ($dateRange as $date) {
        $dayOfWeek = $date->format('N'); // 1 (for Monday) through 7 (for Sunday)
        if ($dayOfWeek >= 1 && $dayOfWeek <= 6) { // Only add Monday to Saturday
            $calendar[$date->format('Y-m-d')] = $date->format('D');
        }
    }

    return $calendar;
}

$start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-d');
$end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d', strtotime('+7 days')); // Default to one week ahead

$calendar = generateCalendar($start, $end);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Calendar</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>

<form method="get" action="">
    <label for="start">Start Date:</label>
    <input type="date" id="start" name="start" value="<?php echo $start; ?>">

    <label for="end">End Date:</label>
    <input type="date" id="end" name="end" value="<?php echo $end; ?>">

    <input type="submit" value="Submit">
</form>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Day</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($calendar as $date => $day): ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $day; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>