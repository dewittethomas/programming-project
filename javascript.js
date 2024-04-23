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
});
