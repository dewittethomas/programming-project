<?php
    $start = 1;
    $current_page = 1;

    if (isset($_GET['page'])) {
        $start = ($_GET['page'] * 10) - 9;
        $current_page = $_GET['page'];
    }
?>